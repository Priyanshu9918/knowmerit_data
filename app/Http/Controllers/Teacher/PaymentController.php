<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;
use Mail;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('front.teacher.payment');
        }

        $rules = [
            'category' => 'required',
            'student' => 'required',
            'board' => 'required',
            'amount' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        DB::beginTransaction();
        try{

            $data = [
                'teacher_id' => Auth::user()->id,
                'student_id' => $request->input('student'),
                'currency' => $request->input('currency'),
                'category' => $request->input('category'),
                'sub_category' => $request->input('sub_category'),
                'board' => $request->input('board'),
                'amount' => $request->input('amount'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $p_id = DB::table('student_payments')->insertGetId($data);

            $c_id = DB::table('student_payments')->where('id',$p_id)->first();
            $currency = DB::table('currency')->where('id',$c_id->currency)->first();

            $user = DB::table('users')->where('id',$request->input('student'))->first();
            $email =
                [
                'sender_email' => $user->email,
                'inext_email' => env('MAIL_USERNAME'),
                'sender_name' => $user->first_name,
                'id' => base64_encode($p_id),
                'currency' => $currency->symbol,
                'amount' => $request->input('amount'),
                'title' => 'Customer Account Registration',
            ];
            Mail::send('mail.payment-link', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                ->from($email['inext_email'], $email['sender_name']);
                $messages->subject("Payment Link for credit!");
            });

            DB::commit();
            return response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function ResetPassword($id) {

        $p_id = base64_decode($id);

        $data = DB::table('student_payments')->where('id',$p_id)->first();
        $data_currency = DB::table('currency')->where('id',$data->currency)->first();
        if($data->status == 0){
            return view('front.student.payment-page', ['data' => $data, 'data_currency' => $data_currency]);
        }
    }
    public function paybook1(Request $request)
    {
        $user = DB::table('student_payments')->where('id',$request->id)->first();
        $credit = DB::table('credits')->where('teacher_id',$user->teacher_id)->where('student_id',$user->student_id)->first();
        if($credit){
            $credit1 = [
                'teacher_id' =>  $user->teacher_id,
                'student_id' => $user->student_id,
                'class_id' => $user->category,
                'sub_id' => $user->sub_category ?? null,
                'credit' => $credit->credit + 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('credits')->where('id',$credit->id)->update($credit1);
        }else{
            $credit1 = [
                'teacher_id' =>  $user->teacher_id,
                'student_id' => $user->student_id,
                'class_id' => $user->category,
                'sub_id' => $user->sub_category ?? null,
                'credit' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('credits')->insert($credit1);
        }

        $dataruser = [
            'payment_status' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ur_id = DB::table('student_payments')->where('id',$request->id)->update($dataruser);
        $refuser = DB::table('users')->where('id', $user->student_id)->first();
        // dd($refuser);
        if ($refuser->referral_code != null && $refuser->referral_by != null) {
            $r = DB::table('referrer')->where('referrer_id', $refuser->referral_code)->where('referral_id', $refuser->referral_by)->first();
            // dd($r);
            if ($r == null) {
                $data1 = [
                    'referrer_id' => $refuser->referral_by,
                    'paid_amount' => $user->amount,
                    'referral_id' => $refuser->referral_code,
                    'referral_amount' => 0,
                    'status' => 1,
                ];
                $referralCount = DB::table('referrer')
                ->where('referrer_id', $refuser->referral_by)
                ->where('status', 1)
                ->count();

                if ($referralCount == 0) {
                // First Referral: 5% Reward
                $data1['referrer_amount'] = 0.05 * $user->amount; // 5% of the purchase amount
                }
                 elseif ($referralCount == 1) {
                    // Second Referral: 7% Reward
                    $data1['referrer_amount'] = 0.07 * $user->amount; // 7% of the purchase amount
                } elseif ($referralCount == 2) {
                    // Third Referral: 10% Reward
                    $data1['referrer_amount'] = 0.10 * $user->amount; // 10% of the purchase amount
                } else

                {
                    $currentMonth = now()->format('Y-m');

                    $referralCount2 = DB::table('referrer')
                                    ->where('referrer_id', $refuser->referral_by)
                                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
                                    ->count();

                    if($referralCount2 < 10 )
                    {
                        $data1['referrer_amount'] = 0.025 * $user->amount; // 2.5% of the purchase amount
                    }
                    else{
                        $data1['referrer_amount'] = 0;
                    }
                }
                $insert2 = DB::table('referrer')->insert($data1);
            }
        }
        return redirect('/');
        // return ('front.dashboard');
    }
}
