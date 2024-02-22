<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Mail\StudentMail;
use App\Mail\StudentPaymentMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Book_a_class;
use App\Models\Student;
use Mail;
use App\Models\Availability;
use App\Models\BookSession;
use Carbon\Carbon;
use App\Models\Credit;

class BookADemoController extends Controller
{
    function autosearch(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::where('name', 'LIKE', $request->category . '%')->where('status',1)->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item" data-id="' . $row->id . '">' . $row->name . '</li></a>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No Data Found' . '</li>';
            }
            return $output;
        }
    }
    ////////////////email varification/////////

    public function checkstdEmail(Request $request)
    {
        $email = $request->input('email');

        $tutor = user::where('email', $email)->first();

        if ($tutor) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
    /////////////Edit Student Profile////////////////////
    public function create_booking_class(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('get')) {
            $parent_cat = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
            // return view('front.book-a-demo', compact('parent_cat'));
        }
        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        $hashed_random_password = Hash::make($request->input('password'));

        DB::beginTransaction();
        try {
            if (!Auth::check()) {
                // if ($request->bnft == 2) {
                if ($request->file('avatar')) {
                    $avatar = $request->file('avatar');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date . $random_no . '.' . $avatar->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/tutors/');
                    if (!File::exists($destination_path)) {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $avatar->move($destination_path, $final_image_name);
                }
                $user = DB::table('users')->where('email', $request->input('email'))->first();
                if ($user != null) {
                    $user_id = $user->id;
                    Auth::loginUsingId($user->id);
                } else {
                    $datauser = [
                        'first_name' => $request->input('first_name'),
                        'name' => $request->input('first_name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'avatar' => !empty($final_image_name) ? $final_image_name : NULL,
                        'user_type' => 3,
                        'password' => $hashed_random_password,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $user_id =    DB::table('users')->insertGetId($datauser);
                }
                $datastudent = [
                    'user_id' => $user_id,
                    'payment_status' => $request->input('payment_status'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('students')->insertGetId($datastudent);
                $data = [
                    'user_id' => $user_id,
                    'category' => $request->input('category'),
                    'sub_category' => $request->input('sub_category'),
                    'pincode' => $request->input('pincode'),
                    'lat' => $request->input('lat'),
                    'lng' => $request->input('lng'),
                    'first_name' => $request->input('first_name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'classes_choice' => $request->input('classes_choice'),
                    'payment_status' => $request->input('payment_status'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('book_a_classes')->insertGetId($data);
                $cat1 = $request->input('category');
                $email = [];
                $id = [];
                $student_enquiry2222 = DB::table("tutors")->get();
                foreach ($student_enquiry2222 as $st) {
                    if (in_array($cat1, explode(',', $st->category))) {
                        $email[] = $st->email;
                        $id[] = $st->user_id;

                    }
                }
                //  dd($id);
                 foreach ($id as $idd) {
                    $Student_id = $user_id;
                    $teacher_id = $idd;
                    $datainsert = [
                        'student_id' => $Student_id,
                        'teacher_id' => $teacher_id,
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                    DB::table('bookclassenquiries')->insertGetId($datainsert);
                }

                if (count($email) > 0) {
                    foreach ($email as $email1) {
                        $email2 =
                            [
                                'sender_email' => $email1,
                                'inext_email' => env('MAIL_USERNAME'),
                                'title' => 'Successfully Registered!',
                            ];

                        Mail::send('mail.student_enquiry', $email2, function ($messages) use ($email2) {
                            $messages->to($email2['sender_email'])
                                ->from($email2['inext_email'], 'Know-merit');
                            $messages->subject("New Student Inquiry.");
                        });
                    }
                }
                session::put('timezone', 'set timezone');

                $user = User::where(['email' => $request->email])->where('user_type', 3)->latest()->first(); //,'user_type'=>'1'

                if ($user) {
                    $check = $request->only('email', 'password');

                    if (Auth::attempt($check)) {
                        if (Auth::user()->user_type == '3') {
                            DB::commit();
                            return response()->json([
                                'success' => true
                            ]);
                        }
                    }
                }
                // }
            } else {

                $data = [
                    'user_id' => Auth::user()->id,
                    'category' => $request->input('category'),
                    'sub_category' => $request->input('sub_category'),
                    'pincode' => $request->input('pincode'),
                    'lat' => $request->input('lat'),
                    'lng' => $request->input('lng'),
                    'first_name' => $request->input('first_name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'classes_choice' => $request->input('classes_choice'),
                    'payment_status' => $request->input('payment_status'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('book_a_classes')->insertGetId($data);
                $dataId = Auth::user()->id;
                $cat1 = $request->input('category');
                $email = [];
                $id = [];
                $student_enquiry2222 = DB::table("tutors")->get();
                foreach ($student_enquiry2222 as $st) {
                    if (in_array($cat1, explode(',', $st->category))) {
                        $email[] = $st->email;
                        $id[] = $st->user_id;
                    }
                }
                // dd($id);
                foreach ($id as $idd) {
                    $Student_id = $dataId;
                    $teacher_id = $idd;
                    $datainsert = [
                        'student_id' => $Student_id,
                        'teacher_id' => $teacher_id,
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                    DB::table('bookclassenquiries')->insertGetId($datainsert);
                }
                if (count($email) > 0) {
                    foreach ($email as $email1) {
                        $email2 =
                            [
                                'sender_email' => $email1,
                                'inext_email' => env('MAIL_USERNAME'),
                                'title' => 'Successfully Registered!',
                            ];

                        Mail::send('mail.student_enquiry', $email2, function ($messages) use ($email2) {
                            $messages->to($email2['sender_email'])
                                ->from($email2['inext_email'], 'Know-merit');
                            $messages->subject("New Student Inquiry.");
                        });
                    }
                }
            }
            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }
    public function razorPaySuccess(Request $request)
    {
        $hashed_random_password = Hash::make($request->input('password'));
        $dataruser = [
            'first_name' => $request->input('first_name'),
            'name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'user_type' => 3,
            'password' => $hashed_random_password,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $ur_id =    DB::table('users')->insertGetId($dataruser);
        $bill_detail = new Student;
        $bill_detail->user_id = $ur_id;
        $bill_detail->payment_status = $request->payment_status ?? '';
        $bill_detail->r_payment_id = $request->payment_id ?? '';
        $bill_detail->amount = $request->amount ?? '';
        $orderCount = Student::count() + 1;
        $bill_detail->order_number = 'KM' .  date('ymdhis') . $orderCount;
        $bill_detail->save();
        $bill_details = new Book_a_class;
        $bill_details->user_id = $ur_id;
        $bill_details->category = $request->category ?? '';
        $bill_details->sub_category = $request->sub_category ?? '';
        $bill_details->pincode = $request->pincode ?? '';
        $bill_details->lat = $request->lat ?? '';
        $bill_details->lng = $request->lng ?? '';
        $bill_details->first_name = $request->first_name ?? '';
        $bill_details->email = $request->email ?? '';
        $bill_details->phone = $request->phone ?? '';
        $bill_details->classes_choice = $request->classes_choice ?? '';
        $bill_details->payment_status = $request->payment_status ?? '';
        $bill_details->r_payment_id = $request->payment_id ?? '';
        $bill_details->amount = $request->amount ?? '';
        $bill_details->save();
        $cat1 = $request->input('category');
        $email = [];
        $id = [];
        $student_enquiry2222 = DB::table("tutors")->get();
        foreach ($student_enquiry2222 as $st) {
            if (in_array($cat1, explode(',', $st->category))) {
                $email[] = $st->email;
                $id[] = $st->user_id;

            }
        }
        foreach ($id as $idd) {
            $Student_id = $ur_id;
            $teacher_id = $idd;
            $datainsert = [
                'student_id' => $Student_id,
                'teacher_id' => $teacher_id,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('bookclassenquiries')->insertGetId($datainsert);
        }
        if (count($email) > 0) {
            foreach ($email as $email1) {
                $email2 =
                    [
                        'sender_email' => $email1,
                        'inext_email' => env('MAIL_USERNAME'),
                        'title' => 'Successfully Registered!',
                    ];

                Mail::send('mail.student_enquiry', $email2, function ($messages) use ($email2) {
                    $messages->to($email2['sender_email'])
                        ->from($email2['inext_email'], 'Know-merit');
                    $messages->subject("New Student Inquiry.");
                });
            }
        }
        if (isset($bill_details)) {

            session::put('timezone', 'set timezone');
            $user = User::where(['email' => $request->email])->where('user_type', 3)->latest()->first(); //,'user_type'=>'1'

            if ($user) {
                $check = $request->only('email', 'password');
                // dd($check);
                if ($user) {
                    Auth::loginUsingId($user->id);
                    DB::commit();
                    return redirect('/student/student-dashboard');
                }
                Session::forget('ist_id');
            }
        }
    }
}
