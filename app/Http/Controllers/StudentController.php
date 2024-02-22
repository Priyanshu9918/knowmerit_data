<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\StudentMail;
use App\Mail\StudentPaymentMail;
use App\Mail\ReferralEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Book_a_class;
use App\Models\Student;
use App\Models\Referral;
use Mail;
use App\Models\Availability;
use App\Models\BookSession;
use Carbon\Carbon;
use App\Models\Credit;

class StudentController extends Controller
{
    public function index()
    {
        $tz     = Auth::user()->load('users.TimeZone');
        $tz     = ($tz->users != null && $tz->users->TimeZone != null) ? $tz->users->TimeZone->timezone : 'Asia/Kolkata';
        $i      = 0;
        $date   = new \DateTime();
        $date->setTimezone(new \DateTimeZone($tz));
        $cur_date = $date->format('Y-m-d H:i:s');
        $data0    = array();
        $data1    = array();
        $data2    = array();

        // $upcommit = BookSession::where('student_id',auth()->user()->id)
        //             ->whereDate('end_time', '>', $cur_date)
        //             ->orderBy('id','DESC')
        //             ->get();
        // $date_set = [$date->format('Y-m-d')];
        // while($i<5)
        // {
        //     $date->modify('-1 month');
        //     $date_set[] = $date->format('Y-m-d');
        //     $data0[] = $date->format('M Y');
        //     $i++;
        // }

        // foreach($date_set as $ds)
        // {
        //     $data1[] = Order::where(['user_id'=>Auth::user()->id,'is_completed'=>1])
        //                     ->whereYear('created_at', date('Y',strtotime($ds)))
        //                     ->whereMonth('created_at', date('m',strtotime($ds)))
        //                     ->count();

        //     $data2[] = CreditLog::where(['user_id'=>Auth::user()->id])
        //                     ->whereYear('created_at', date('Y',strtotime($ds)))
        //                     ->whereMonth('created_at', date('m',strtotime($ds)))
        //                     ->sum('credit');

        // }

        // dd($data2);
        return view('front.student-dashboard', compact('tz'));
    }
    public function create_demo_class(Request $request)
    {
        if ($request->isMethod('get')) {
            $parent_cat = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
            return view('front.book-a-demo', compact('parent_cat'));
        }
        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'avatar' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',

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
            if ($request->bnft == 2) {
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
                $u_id =    DB::table('users')->insertGetId($datauser);
                $datastudent = [
                    'user_id' => $u_id,
                    'payment_status' => $request->input('payment_status'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('students')->insertGetId($datastudent);
                $data = [
                    'user_id' => $u_id,
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
                $dataId =    DB::table('book_a_classes')->insertGetId($data);
                // $student_enquiry2222 = DB::table("tutors")->pluck('category','email')->toArray();
                $cat1 = $request->input('category');
                $email = [];
                // $name = [];
                $student_enquiry2222 = DB::table("tutors")->get();
                foreach ($student_enquiry2222 as $st) {
                    if (in_array($cat1, explode(',', $st->category))) {
                        $email[] = $st->email;
                        $id[] = $st->user_id;
                    }
                }
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
        // $name = [];
        $student_enquiry2222 = DB::table("tutors")->get();
        foreach ($student_enquiry2222 as $st) {
            if (in_array($cat1, explode(',', $st->category))) {
                $email[] = $st->email;
                $id[] = $st->user_id;

            }
        }
        foreach ($id as $idd) {
            $Student_id = $bill_details->id;
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
            // $data = [
            //     'user_id' => $bill_details->id,
            //     'r_payment_id' => $request->payment_id,
            //     'amount' => $request->amount,
            // ];
            // $getId = DB::table('payments')->insertGetId($data);
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
    public function subCategoryList(Request $request)
    {
        $category_id = $request->category;

        $sub_category = DB::table('categories')->select('id', 'name')->where('parent', $category_id)->where('status', 1)->get();
        if (count($sub_category) > 0) {
            return response()->json([
                'success' => true,
                'value' => $sub_category
            ]);
        } else
            return response()->json([
                'success' => false,
            ]);
    }
    ////////////////student/////////////////////////////

    public function createstudent(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('front.create-student');
        }
        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
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

            if ($request->has('referral_code') && $request->get('referral_code') != '') {
                $datauser = [
                    'first_name' => $request->input('first_name'),
                    'name' => $request->input('first_name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'user_type' => 3,
                    'password' => $hashed_random_password,
                    'referral_by' => $request->referral_code,
                    'referral_code' => date('ymdhis'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert = DB::table('users')->insertGetId($datauser);
                $aa = Session::put('ist_id', $insert);
                // $data1 = [
                //     'referrer_id' => $datauser['referral_by'],
                //     'referrer_amount' => 4,
                //     'referral_id' => $datauser['referral_code'],
                //     'referral_amount'=>6,
                //     'status' => 1,
                // ];
                // dd($data1);
                // $insert2 =   DB::table('referrer')->insert($data1);
                // $aa2 = Session::put('ist_id', $insert2);


            } else {
                $datauser1 = [
                    'first_name' => $request->input('first_name'),
                    'name' => $request->input('first_name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'user_type' => 3,
                    'password' => $hashed_random_password,
                    'referral_code' => date('ymdhis'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert1 =   DB::table('users')->insertGetId($datauser1);
                $aa1 = Session::put('ist_id', $insert1);
            }
            //  $pass = Session::put('password' , $request->password);

            DB::commit();
            return response()->json([
                'success' => true
            ]);
            // return view('front.create-student-nxt-step');

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }
    public function createstudentnxtstep(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('front.create-student-nxt-step');
        }
        $rules = [
            'payment_status' => 'required'
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            if ($request->bnft == 2) {
                $datauser = [
                    'user_id' => $request->user_id,
                    'payment_status' => $request->input('payment_status'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('students')->insertGetId($datauser);
                $user = DB::table('users')->where('id', $request->user_id)->first();
                mail::to($user->email)->send(new StudentMail($datauser));
                //  $pass = Session::get('password');
                //  dd($pass);
                session::put('timezone', 'set timezone');
                $user = User::where(['email' => $user->email])->where('user_type', 3)->latest()->first(); //,'user_type'=>'1'

                if ($user) {
                    Auth::loginUsingId($user->id);
                    DB::commit();
                    return response()->json([
                        'success' => true
                    ]);
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
    public function timezone(Request $request)
    {
        $id = Auth::user()->id;
        $con =  DB::table('users')->where('id', $id)->update([
            'country'    => $request->country1,
            'timezone'      => $request->timezone1,
        ]);

        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function timezone1(Request $request)
    {
        $id = Auth::user()->id;
        $con =  DB::table('users')->where('id', $id)->update([
            'country'    => $request->country,
            'timezone'      => $request->timezone,
        ]);

        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function razorPaySuccesspayment(Request $request)
    {
        $bill_details = new Student;
        $bill_details->user_id = $request->user_id;
        $bill_details->payment_status = $request->payment_status ?? '';
        $bill_details->r_payment_id = $request->payment_id ?? '';
        $bill_details->amount = $request->amount ?? '';
        $orderCount = Student::count() + 1;
        $bill_details->order_number = 'KM' .  date('ymdhis') . $orderCount;
        $bill_details->save();
        if (isset($bill_details)) {
            // $datauser = [
            //     'user_id' => $request->user_id,
            //     'r_payment_id' => $request->payment_id,
            //     'amount' => $request->amount,
            // ];
            // $getId = DB::table('payments')->insertGetId($datauser);
            $user = DB::table('users')->where('id', $request->user_id)->first();
            mail::to($user->email)->send(new StudentPaymentMail($bill_details));
            session::put('timezone', 'set timezone');
            Session::forget('ist_id');
            session::put('timezone', 'set timezone');
            $user = User::where(['email' => $user->email])->where('user_type', 3)->latest()->first(); //,'user_type'=>'1'

            if ($user) {
                Auth::loginUsingId($user->id);
                DB::commit();
                return redirect('/student/student-dashboard');
            }
        }
    }
    ////////////////email varification/////////

    public function checkstudentEmail(Request $request)
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
    public function student_profile_edit(Request $request)
    {
        $id = Auth::user()->id;
        $data = DB::table('users')->where('id', $id)->first();
        $data2 = DB::table('students')->where('user_id', $id)->first();
        return view('front.student.profile', compact('data', 'data2'));
    }

    public function student_profile_update(Request $request)
    {
        $id = Auth::user()->id;
        $con =  DB::table('users')->where('id', $id)->update([
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        DB::commit();
        return redirect('/student/student-dashboard');
    }
    //////////////////student profile img///////////////
    public function student_profile_edit_img(Request $request)
    {
        $id = Auth::user()->id;
        $data = DB::table('users')->where('id', $id)->first();
        $data2 = DB::table('students')->where('user_id', $id)->first();
        return view('front.student.profile', compact('data', 'data2'));
    }

    public function student_profile_update_img(Request $request)
    {
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
        $id = Auth::user()->id;
        $con =  DB::table('users')->where('id', $id)->update([
            'avatar' => !empty($final_image_name) ? $final_image_name : NULL,
        ]);
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    ///////////////////////complete edit section/////
    public function cal_data(Request $request)
    {
        // date_default_timezone_set("Europe/Paris");
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // $tz1    = '1.00';
        $t_user = DB::table('users')->where('id', Auth::user()->id)->first();
        $tz_f   = DB::table('time_zones')->where('id', $t_user->timezone)->first();
        $tz = $tz_f->timezone ?? 'Asia/Kolkata';
        $tz1 = $tz_f->raw_offset ?? '1.00';
        date_default_timezone_set($tz);

        $class_id   = $request->c_id;
        $sub_id   = $request->s_id;
        $teacher_id = $request->t_id;
        // $c_detail   = Pricing::where('id',$class_id)->first();

        $teacher_av = Availability::where('user_id', $teacher_id)->get();
        $interval   = '60';
        $interval   = (int)$interval;
        $day        = array();
        $events     = array();
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {
            $interval   = '60';

            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

            $st = Carbon::parse($startTime)->format('H:i');
            $end = Carbon::parse($endTime)->format('H:i');

            if($end == '00:00'){
                $interval   = '59';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-1 minutes");;
                $endTime1 = $endTime1->format('h:i A');

                $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
                $endTime->setTimezone(new \DateTimeZone($tz));

            }
            // if($end == '00:15'){
            //     $interval   = '44';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-16 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }
            // if($end == '00:20'){
            //     $interval   = '39';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-21 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:25'){
            //     $interval   = '34';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-26 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }
            
            if($end == '00:30'){
                $interval   = '29';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-31 minutes");
                $endTime1 = $endTime1->format('h:i A');

                $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
                $endTime->setTimezone(new \DateTimeZone($tz));

            }
            
            if ($startTime > $endTime) {
                // dd('yes ');
                // $startTime  = new \DateTime(date('Y-m-d').' '.$startTime->format('H:i:s'));
                // $endTime    = new \DateTime(date('Y-m-d').' '.$endTime->format('H:i:s'));
                $endTime = $endTime->modify('+1 day');
            }

            // dd(date('Y-m-d').' '.$t_av->time_from,date('Y-m-d').' '.$t_av->time_to);
            // dd($startTime,$endTime);
            while ($startTime < $endTime) {
                $st = $startTime->format('H:i:s');
                $et = $startTime->modify('+' . $interval . ' minutes');
                $et2 = $et->format('Y-m-d H:i:s');
                // echo strtotime($et2).'<='.strtotime($endTime->format('Y-m-d H:i:s')).'<br>';
                if (strtotime($et2) <= strtotime($endTime->format('Y-m-d H:i:s'))) {
                    // echo $st.'='.$et->format('H:i:s').''.strtotime($et2).'<br>';
                    $day[$t_av->day][] = array('from' => $st, 'to' => $et->format('H:i:s'), 'check' => '', 'f1' => $st, 't1' => $et->format('H:i:s'));
                }
            }
            // dd($day);

        }
        // dd($day);
        $s_date = strtotime(date('Y-m-d h:i a'));
        for ($i = 0; $i <= 30; $i++) {
            $c_date = date('Y-m-d h:i A', strtotime('+' . $i . ' days', $s_date));
            $d_date = date('D', strtotime('+' . $i . ' days', $s_date));
            $d_date = strtolower($d_date);
            if (isset($day[$d_date]) && count($day[$d_date]) > 0) {
                foreach ($day[$d_date] as $da) {
                    $s_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                    $e_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];

                    $start  = date('Y-m-d', strtotime($s_time_01)) . 'T' . date('H:i:00', strtotime($s_time_01));
                    $cate   = date('d M Y', strtotime($s_time_01)) . ' at ' . date('h:i A', strtotime($s_time_01));
                    $end    = date('Y-m-d', strtotime($e_time_01)) . 'T' . date('H:i:00', strtotime($e_time_01));

                    $timeCom = strtotime(date('Y-m-d H:i', strtotime('+24 hour', $s_date)));
                    $timeCom2 = strtotime($s_time_01);

                    if ($timeCom < $timeCom2) {
                        $s_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                        $e_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];
                        //time convert into UTC
                        $time_from_t1   = new \DateTime($s_time_02, new \DateTimeZone($tz));
                        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
                        $s_time_02    = $time_from_t1->format("Y-m-d h:i A");

                        $time_to_t1   = new \DateTime($e_time_02, new \DateTimeZone($tz));
                        $time_to_t1->setTimezone(new \DateTimeZone('UTC'));
                        $e_time_02    = $time_to_t1->format("Y-m-d h:i A");

                        $check  = BookSession::where('teacher_id', $teacher_id)
                            ->where(function ($qry) use ($s_time_02, $e_time_02) {
                                $qry->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                    $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                        ->where('end_time', '<', date('Y-m-d H:i', strtotime($e_time_02)))
                                        ->where('end_time', '>', date('Y-m-d H:i', strtotime($s_time_02)));
                                    // ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                })
                                    ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                        $query->where('start_time', '>=', date('Y-m-d H:i', strtotime($s_time_02)))
                                            ->where('end_time', '<=', date('Y-m-d H:i', strtotime($e_time_02)));
                                    })
                                    ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                        $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                            ->where('end_time', '>=', date('Y-m-d H:i', strtotime($e_time_02)));
                                    });
                            })->where('is_cancelled', 0)
                            ->where('teacher_url','<>',null)
                            ->first();

                        // $check = null;
                        if ($check == null) {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Available Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['A', 'B', 'C'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'green',
                                'hereText'   => 'TEXT TEST',
                            );
                        } else {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Booked Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['D', 'D'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'grey',
                                'hereText'   => 'TEXT TEST',
                            );
                        }
                    }
                }
            }
        }
        //Find Unavailability
        // date_default_timezone_set('UTC');
        // $unavailable = Unavailability::where('teacher_id',$teacher_id)->where('start_time','>=',date('Y-m-d H:i:00'))->get();
        // // dd($unavailable);
        // date_default_timezone_set($tz);
        // foreach($unavailable as $un)
        // {
        //     $b_time_from   = new \DateTime($un->start_time, new \DateTimeZone('UTC'));
        //                     $b_time_to     = new \DateTime($un->end_time, new \DateTimeZone('UTC'));

        //                     $b_time_from->setTimezone(new \DateTimeZone($tz));
        //                     $b_time_to->setTimezone(new \DateTimeZone($tz));

        //                     $tf_time    = $b_time_from->format("Y-m-d H:i");
        //                     $tt_time    = $b_time_to->format("Y-m-d H:i");

        //     $events[] = array(  'id'        =>'1',
        //                     'calendarId'=> 'cal1',
        //                     'title'     => 'Unavailable',
        //                     'body'      => '',
        //                     'start'     => str_replace(' ','T',$tf_time),
        //                     'end'       => str_replace(' ','T',$tt_time),
        //                     'location'  => 'Meeting Room A',
        //                     'attendees' => ['B', 'B' , 'C'],
        //                     'category'  => 'time',
        //                     'state'     => 'Free',
        //                     'color'     => '#fff',
        //                     'text01'    => '',
        //                     'backgroundColor' => 'red',
        //                     'customStyle' => [
        //                         'z-index' => '999999',
        //                     ],
        //                 );
        // }
        // dd($events);

        $html = view('front.cal', compact('events', 'tz', 'tz1', 'class_id', 'sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id' => $class_id, 'sub_id' => $sub_id]);
    }

    public function book_session(Request $req)
    {
        // dd($req->all());
        // dd($req->all());
        $t_user = DB::table('users')->where('id', Auth::user()->id)->first();
        $tz_f   = DB::table('time_zones')->where('id', $t_user->timezone)->first();
        $tz = $tz_f->timezone ?? 'Asia/Kolkata';
        $tz1 = $tz_f->raw_offset ?? '1.00';
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // $tz1    = '1.00';

        $date_time  = str_replace('at ', '', $req->get('date_time'));

        $time_from_t1   = new \DateTime($date_time, new \DateTimeZone($tz));
        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
        $tf_time        = $time_from_t1->format("Y-m-d h:i A");

        // $c_detail   = Pricing::where('id',$req->get('class_id'))->first();

        $start_time = date('Y-m-d H:i', strtotime($tf_time));
        // $interval   = ($c_detail!=null && $c_detail->time!=null)?$c_detail->time:'00';
        $interval   = '60';
        $end_time   = date('Y-m-d H:i', strtotime('+' . $interval . ' minutes', strtotime($tf_time)));

        $randomNumber = random_int(1000000, 9999999);

        $insert_arr = array(
            'class_id'      => $req->get('class_id'),
            'sub_id'      => $req->get('sub_id'),
            'student_id'    => $req->get('student_id'),
            'teacher_id'    => $req->get('teacher_id'),
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'duration'      => $interval,
            'created_at'    => Carbon::now()
        );

        $insert_id  = BookSession::create($insert_arr)->id;
        if ($insert_id != null) {
            $url = route('student.book.session.merithub', $insert_id);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }

    // public function merithub_create_class(Request $req)
    // {
    //     echo 'here implement and redirect to my-classis';
    // }

    public function merithub_create_class(Request $request)
    {
        // dd($request->id);
        $check = BookSession::find($request->id);
        if ($check != null) {
            DB::beginTransaction();
            try {
                //MeritHubIntegration here
                $merithub  = DB::table('merithub_creditionals')->first();
                $t_user    = DB::table('users')->where('id', $check->teacher_id)->first();
                $s_user    = DB::table('users')->where('id', $check->student_id)->first();

                $tutor     = DB::table('users')->where('id', $check->teacher_id)->first();
                $tutor_img = ($tutor != null && $tutor->avatar != null) ? url('uploads/tutors/') . '/' . $tutor->avatar : 'https://www.knowmerit.com/assets/img/logo/logo.png';

                $student   = DB::table('users')->where('id', $check->student_id)->first();
                $student_img = ($student != null && $student->avatar != null) ? url('uploads/tutors/') . '/' . $student->avatar : 'https://www.knowmerit.com/assets/img/logo/logo.png';

                $tt        = ($tutor != null && $tutor->timezone != null) ? $tutor->timezone : '195';
                $timezone1 = DB::table('time_zones')->where('id', $tt)->first();
                $st        = ($student != null && $student->timezone != null) ? $student->timezone : '195';
                $timezone  = DB::table('time_zones')->where('id', $st)->first();
                $timesx     = $check->start_time;

                $tz        = $timezone->timezone;

                $t1        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t1->setTimezone(new \DateTimeZone($tz));
                $times     = $t1->format("Y-m-d h:i A");

                $t2        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t2->setTimezone(new \DateTimeZone($timezone1->timezone));
                $times2    = $t2->format("Y-m-d h:i A");

                $startTime = date('Y-m-d', (strtotime($times))) . 'T' . date('H:i:s', (strtotime($times)));

                $headers   = array("content-type: application/json", "Authorization:" . $merithub->merithub_token);


                if (empty($t_user->mh_user_id)) {
                    $url    = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";
                    $data   = array(
                        "name" => $t_user->name,
                        "img" => $tutor_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $t_user->id,
                        "email" => $t_user->email,
                        "role" => "M",
                        "timeZoneId" => $timezone1->timezone,
                        "permission" => "CJ"
                    );

                    $post_data  = json_encode($data);

                    $curl       = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    $result = curl_exec($curl);
                    curl_close($curl);

                    $getUserId      = json_decode($result);
                    $mh_user_id     = $getUserId->userId;
                    $update         = DB::table('users')->where('id', $t_user->id)->update(['mh_user_id' => $mh_user_id]);
                } else {
                    $mh_user_id = $t_user->mh_user_id;

                    $this->meritHubUserUpdate($merithub->client_id, $mh_user_id, $tutor_img, $timezone1->timezone, $t_user, $headers);
                    // die('end');
                }

                if (empty($s_user->mh_user_id)) {
                    // dd($merithub->client_id);
                    $url2   = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";

                    $data2  = array(
                        "name" => $s_user->name,
                        "img" => $student_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $s_user->id,
                        "email" => $s_user->email,
                        "role" => "M",
                        "timeZoneId" => $timezone->timezone,
                        "permission" => "CJ"
                    );

                    $post_data2 = json_encode($data2);

                    $curl2      = curl_init($url2);
                    curl_setopt($curl2, CURLOPT_URL, $url2);
                    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl2, CURLOPT_POST, 1);
                    curl_setopt($curl2, CURLOPT_POSTFIELDS, $post_data2);
                    curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
                    $result2 = curl_exec($curl2);
                    curl_close($curl2);

                    $getUserId2  = json_decode($result2);
                    // dd($getUserId2);
                    $mh_user_id2 = $getUserId2->userId;
                    $update      = DB::table('users')->where('id', $s_user->id)->update(['mh_user_id' => $mh_user_id2]);
                } else {
                    $mh_user_id2 = $s_user->mh_user_id;

                    $this->meritHubUserUpdate($merithub->client_id, $mh_user_id2, $student_img, $timezone->timezone, $s_user, $headers);
                }

                // Schedule Class CURL
                $url1     = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $mh_user_id . "";

                $data1 = array(
                    "title" => $s_user->name . ' ' . 'Session',
                    "startTime" => $startTime,
                    "recordingDownload" => false,
                    "downloadRecording" => false,
                    "duration" => $check->duration,
                    "lang" => "en",
                    "timeZoneId" => $timezone->timezone,
                    "type" => "oneTime",
                    "access" => "private",
                    "login" => false,
                    "layout" => "CR",
                    "status" => "up",
                    "recording" => array("record" => false, "autoRecord" => false, "recordingControl" => true)
                );

                $post_data1 = json_encode($data1);
                $curl1 = curl_init($url1);
                curl_setopt($curl1, CURLOPT_URL, $url1);
                curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl1, CURLOPT_POST, 1);
                curl_setopt($curl1, CURLOPT_POSTFIELDS, $post_data1);
                curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
                $result1 = curl_exec($curl1);
                curl_close($curl1);

                $getClass = json_decode($result1);
                // dd($getClass);
                $classId               = $getClass->classId;
                $TutorJoinLink         = $getClass->hostLink;
                $commonParticipantLink = $getClass->commonLinks->commonParticipantLink;
                // End Schedule Class CURL

                $url3       = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $classId . "/users";
                $data3      = array("users" => array(array("userId" => $mh_user_id2, "userLink" => $commonParticipantLink, "userType" => "su", "timeZoneId" => $timezone1->timezone,)));
                $post_data3 = json_encode($data3);

                $curl3      = curl_init($url3);
                curl_setopt($curl3, CURLOPT_URL, $url3);
                curl_setopt($curl3, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl3, CURLOPT_POST, 1);
                curl_setopt($curl3, CURLOPT_POSTFIELDS, $post_data3);
                curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
                $result3 = curl_exec($curl3);
                curl_close($curl3);
                $getSession = json_decode($result3);
                $StudentJoinLink = $getSession[0]->userLink;

                $TutorJoinLink   = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $TutorJoinLink;
                $StudentJoinLink = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $StudentJoinLink;
                $RecordingURL    = "https://merithub.com/" . $merithub->client_id . "/sessions/view/" . $classId . "/" . $commonParticipantLink;
                // End MerihHub Integration

                //Decrease credit
                Credit::where(['student_id' => auth()->user()->id, 'teacher_id' => $check->teacher_id])->decrement('credit', 1);

                // Update book Session
                $check->student_url = $StudentJoinLink;
                $check->teacher_url = $TutorJoinLink;
                $check->record_url  = $RecordingURL;
                $check->is_booked   = 1;
                $check->save();

                $class_details = DB::table('categories')->where('id', $check->class_id)->first();
                // Email for student
                $email =
                    [
                        'sender_email' => $s_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        's_name' => $s_user->name,
                        't_name' => $t_user->name,
                        'student_url' => $StudentJoinLink,
                        'title' => 'Student Class Booking Email',
                        'class_time' => $times,
                        'class_name' => $class_details->name,
                    ];
                    // dd($email);
                Mail::send('mail.student-booking', $email, function ($messages) use ($email) {
                    $messages->to($email['sender_email'])
                        ->from($email['inext_email'], 'Know-merit');
                    $messages->subject("Class Booking Confirmation.");
                });

                // Email for Teacher
                $email2 =
                    [
                        'sender_email' => $t_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        't_name' => $t_user->name,
                        's_name' => $s_user->name,
                        'teacher_url' => $TutorJoinLink,
                        'title' => 'Successfully Registered!',
                        'class_time' => $times2,
                        'class_name' => $class_details->name,

                    ];
                // dd($email2);
                Mail::send('mail.teacher-booking', $email2, function ($messages) use ($email2) {
                    $messages->to($email2['sender_email'])
                        ->from($email2['inext_email'], 'Know-merit');
                    $messages->subject("New Lesson Booking.");
                });

                DB::commit();
                return redirect()->route('student.student-dashboard')->with('success', 'Class created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                echo '<b>ERROR : </b>' . $e; //$e->getMessage()
                die;
            }
        } else {
            return redirect()->route('student.student-dashboard')->with('error', 'Oops something went wrong');
        }
    }
    public function meritHubUserUpdate($c_id, $mu_id, $u_img, $tz, $u_data, $headers)
    {

        $url    = "https://serviceaccount1.meritgraph.com/v1/" . $c_id . "/users/" . $mu_id;
        $data   = array(
            "name" => $u_data->name,
            "img" => $u_img,
            "lang" => "en",
            "clientUserId" => "LATOGO-" . $u_data->id,
            "email" => $u_data->email,
            "role" => "M",
            "timeZoneId" => $tz,
            "permission" => "CJ"
        );

        $post_data  = json_encode($data);

        $curl       = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        curl_close($curl);

        // dd($result);
        return true;
    }
    public function cancleclass(Request $request)
    {
        $id = $request->active;
        $user_id = Auth::user()->id;

        DB::beginTransaction();
        try {
            $data = [
                'is_cancelled' => 1,
                'cancelled_by' => $user_id,
            ];

            DB::table('book_sessions')->where('id', $id)->update($data);

            $book_session = BookSession::where('id', $id)->first();
            $teacher = DB::table('users')->where('id', $book_session->teacher_id)->first();
            $student = DB::table('users')->where('id', $book_session->student_id)->first();


            $email2 =
                [
                    'sender_email' => $student->email,
                    'inext_email' => env('MAIL_USERNAME'),
                    't_name' => $student->name,
                    's_name' => $teacher->name,
                    'title' => 'Class cancelled!',
                ];
            Mail::send('mail.student-cancle-class', $email2, function ($messages) use ($email2) {
                $messages->to($email2['sender_email'])
                    ->from($email2['inext_email'], 'Knowmerit');
                $messages->subject(" Cancellation Notice - Keep the Learning Spirit Alive!");
            });

            $email =
                [
                    'sender_email' => $teacher->email,
                    'inext_email' => env('MAIL_USERNAME'),
                    't_name' => $student->name,
                    's_name' => $teacher->name,
                    'title' => 'Class cancelled!',
                ];

            Mail::send('mail.teacher-cancle', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                    ->from($email['inext_email'], 'Knowmerit');
                $messages->subject("Cancellation Notice - Keep the Learning Spirit Alive!");
            });

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
    public function teacher(Request $request)
    {
        $data = DB::table('credits')->where('student_id', Auth::user()->id)->get();
        return view('front.student.teacher', compact('data'));
    }

    public function dash(Request $request)
    {
        $id = $request->active;
        $s_id = Auth::user()->id;
        $video = Db::table('student_videos')->where('teacher_id', $id)->where('student_id', $s_id)->get();
        $homework = Db::table('student_documents')->where('d_type', 'homework')->where('teacher_id', $id)->where('student_id', $s_id)->get();
        $test = Db::table('student_mcqs')->where('teacher_id', $id)->where('student_id', $s_id)->get();
        $document = Db::table('student_documents')->where('d_type', 'document')->where('teacher_id', $id)->where('student_id', $s_id)->get();
        return view('front.student.st-dashboard', compact('id', 'test', 'video', 'homework', 'document'));
    }



    //     public function sendReferralEmail(Request $request) {
    //         $rules = [
    //             'sendmail' =>'required',

    //         ];
    //         $id = Auth::user()->id;
    //         $referralCode =Db::table('users')->where('id', $id)->first();
    //         Mail::to($request->input('sendmail'))->send(new ReferralEmail($referralCode));

    //     return redirect()->back()->with('success', 'Referral email sent successfully!');
    // }
    public function sendReferralEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sendmail' => 'required|email',
        ]);

        if ($validator->fails()) {
            // If validation fails, return errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $id = Auth::user()->id;
        $referralCode = Db::table('users')->where('id', $id)->first();

        Mail::to($request->input('sendmail'))->send(new ReferralEmail($referralCode));

        return redirect()->back()->with('success', 'Referral email sent successfully!');
    }

    public function r_cal_data(Request $request)
    {
        $id = $request->id;
        $book_session = BookSession::where('id', $id)->first();
        $t_user = DB::table('users')->where('id', $book_session->student_id)->first();
        $tz_f   = DB::table('time_zones')->where('id', $t_user->timezone)->first();
        $tz = $tz_f->timezone ?? 'Asia/Kolkata';
        $tz1 = $tz_f->raw_offset ?? '1.00';
        date_default_timezone_set($tz);

        $student_id = $book_session->student_id;
        $class_id   = $book_session->class_id;
        $sub_id   = $book_session->sub_id;
        $teacher_id = $book_session->teacher_id;
        // $c_detail   = Pricing::where('id',$class_id)->first();

        $teacher_av = Availability::where('user_id', $teacher_id)->get();
        $interval   = '60';
        $interval   = (int)$interval;
        $day        = array();
        $events     = array();
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {

            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

            if ($startTime > $endTime) {
                // dd('yes ');
                // $startTime  = new \DateTime(date('Y-m-d').' '.$startTime->format('H:i:s'));
                // $endTime    = new \DateTime(date('Y-m-d').' '.$endTime->format('H:i:s'));
                $endTime = $endTime->modify('+1 day');
            }

            // dd(date('Y-m-d').' '.$t_av->time_from,date('Y-m-d').' '.$t_av->time_to);
            // dd($startTime,$endTime);
            while ($startTime < $endTime) {
                $st = $startTime->format('H:i:s');
                $et = $startTime->modify('+' . $interval . ' minutes');
                $et2 = $et->format('Y-m-d H:i:s');
                // echo strtotime($et2).'<='.strtotime($endTime->format('Y-m-d H:i:s')).'<br>';
                if (strtotime($et2) <= strtotime($endTime->format('Y-m-d H:i:s'))) {
                    // echo $st.'='.$et->format('H:i:s').''.strtotime($et2).'<br>';
                    $day[$t_av->day][] = array('from' => $st, 'to' => $et->format('H:i:s'), 'check' => '', 'f1' => $st, 't1' => $et->format('H:i:s'));
                }
            }
            // dd($day);

        }
        // dd($day);
        $s_date = strtotime(date('Y-m-d h:i a'));
        for ($i = 0; $i <= 30; $i++) {
            $c_date = date('Y-m-d h:i A', strtotime('+' . $i . ' days', $s_date));
            $d_date = date('D', strtotime('+' . $i . ' days', $s_date));
            $d_date = strtolower($d_date);
            if (isset($day[$d_date]) && count($day[$d_date]) > 0) {
                foreach ($day[$d_date] as $da) {
                    $s_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                    $e_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];

                    $start  = date('Y-m-d', strtotime($s_time_01)) . 'T' . date('H:i:00', strtotime($s_time_01));
                    $cate   = date('d M Y', strtotime($s_time_01)) . ' at ' . date('h:i A', strtotime($s_time_01));
                    $end    = date('Y-m-d', strtotime($e_time_01)) . 'T' . date('H:i:00', strtotime($e_time_01));

                    $timeCom = strtotime(date('Y-m-d H:i', strtotime('+24 hour', $s_date)));
                    $timeCom2 = strtotime($s_time_01);

                    if ($timeCom < $timeCom2) {
                        $s_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                        $e_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];
                        //time convert into UTC
                        $time_from_t1   = new \DateTime($s_time_02, new \DateTimeZone($tz));
                        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
                        $s_time_02    = $time_from_t1->format("Y-m-d h:i A");

                        $time_to_t1   = new \DateTime($e_time_02, new \DateTimeZone($tz));
                        $time_to_t1->setTimezone(new \DateTimeZone('UTC'));
                        $e_time_02    = $time_to_t1->format("Y-m-d h:i A");

                        $check  = BookSession::where('teacher_id', $teacher_id)
                            ->where(function ($qry) use ($s_time_02, $e_time_02) {
                                $qry->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                    $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                        ->where('end_time', '<', date('Y-m-d H:i', strtotime($e_time_02)))
                                        ->where('end_time', '>', date('Y-m-d H:i', strtotime($s_time_02)));
                                    // ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                })
                                    ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                        $query->where('start_time', '>=', date('Y-m-d H:i', strtotime($s_time_02)))
                                            ->where('end_time', '<=', date('Y-m-d H:i', strtotime($e_time_02)));
                                    })
                                    ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                        $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                            ->where('end_time', '>=', date('Y-m-d H:i', strtotime($e_time_02)));
                                    });
                            })->where('is_cancelled', 0)
                            ->first();

                        // $check = null;
                        if ($check == null) {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Available Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['A', 'B', 'C'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'green',
                                'hereText'   => 'TEXT TEST',
                            );
                        } else {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Booked Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['D', 'D'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'grey',
                                'hereText'   => 'TEXT TEST',
                            );
                        }
                    }
                }
            }
        }
        //Find Unavailability
        // date_default_timezone_set('UTC');
        // $unavailable = Unavailability::where('teacher_id',$teacher_id)->where('start_time','>=',date('Y-m-d H:i:00'))->get();
        // // dd($unavailable);
        // date_default_timezone_set($tz);
        // foreach($unavailable as $un)
        // {
        //     $b_time_from   = new \DateTime($un->start_time, new \DateTimeZone('UTC'));
        //                     $b_time_to     = new \DateTime($un->end_time, new \DateTimeZone('UTC'));

        //                     $b_time_from->setTimezone(new \DateTimeZone($tz));
        //                     $b_time_to->setTimezone(new \DateTimeZone($tz));

        //                     $tf_time    = $b_time_from->format("Y-m-d H:i");
        //                     $tt_time    = $b_time_to->format("Y-m-d H:i");

        //     $events[] = array(  'id'        =>'1',
        //                     'calendarId'=> 'cal1',
        //                     'title'     => 'Unavailable',
        //                     'body'      => '',
        //                     'start'     => str_replace(' ','T',$tf_time),
        //                     'end'       => str_replace(' ','T',$tt_time),
        //                     'location'  => 'Meeting Room A',
        //                     'attendees' => ['B', 'B' , 'C'],
        //                     'category'  => 'time',
        //                     'state'     => 'Free',
        //                     'color'     => '#fff',
        //                     'text01'    => '',
        //                     'backgroundColor' => 'red',
        //                     'customStyle' => [
        //                         'z-index' => '999999',
        //                     ],
        //                 );
        // }
        // dd($events);

        $html = view('front.student.cal3', compact('events', 'tz', 'tz1', 'class_id', 'sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id' => $class_id, 'sub_id' => $sub_id, 'teacher_id' => $teacher_id, 'session_id' => $id]);
    }

    public function r_book_session(Request $req)
    {
        // dd($req->all());
        // dd($req->all());
        $t_user = DB::table('users')->where('id', Auth::user()->id)->first();
        $tz_f   = DB::table('time_zones')->where('id', $t_user->timezone)->first();
        $tz = $tz_f->timezone ?? 'Asia/Kolkata';
        $tz1 = $tz_f->raw_offset ?? '1.00';
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // $tz1    = '1.00';

        $date_time  = str_replace('at ', '', $req->get('date_time'));

        $time_from_t1   = new \DateTime($date_time, new \DateTimeZone($tz));
        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
        $tf_time        = $time_from_t1->format("Y-m-d h:i A");

        // $c_detail   = Pricing::where('id',$req->get('class_id'))->first();

        $start_time = date('Y-m-d H:i', strtotime($tf_time));
        // $interval   = ($c_detail!=null && $c_detail->time!=null)?$c_detail->time:'00';
        $interval   = '60';
        $end_time   = date('Y-m-d H:i', strtotime('+' . $interval . ' minutes', strtotime($tf_time)));

        $randomNumber = random_int(1000000, 9999999);

        $insert_arr = array(
            'class_id'      => $req->get('class_id'),
            'sub_id'      => $req->get('sub_id'),
            'student_id'    => $req->get('student_id'),
            'teacher_id'    => $req->get('teacher_id'),
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'duration'      => $interval,
            'created_at'    => Carbon::now()
        );

        BookSession::where('id', $req->session_id)->update($insert_arr);
        if ($req->session_id != null) {
            $url = route('student.r_book.session.merithub', $req->session_id);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }

    // public function merithub_create_class(Request $req)
    // {
    //     echo 'here implement and redirect to my-classis';
    // }

    public function r_merithub_create_class(Request $request)
    {
        // dd($request->id);
        $check = BookSession::find($request->id);
        if ($check != null) {
            DB::beginTransaction();
            try {
                //MeritHubIntegration here
                $merithub  = DB::table('merithub_creditionals')->first();
                $t_user    = DB::table('users')->where('id', $check->teacher_id)->first();
                $s_user    = DB::table('users')->where('id', $check->student_id)->first();

                $tutor     = DB::table('users')->where('id', $check->teacher_id)->first();
                $tutor_img = ($tutor != null && $tutor->avatar != null) ? url('uploads/tutors/') . '/' . $tutor->avatar : 'https://www.knowmerit.com/assets/img/logo/logo.png';

                $student   = DB::table('users')->where('id', $check->student_id)->first();
                $student_img = ($student != null && $student->avatar != null) ? url('uploads/tutors/') . '/' . $student->avatar : 'https://www.knowmerit.com/assets/img/logo/logo.png';

                $tt        = ($tutor != null && $tutor->timezone != null) ? $tutor->timezone : '195';
                $timezone1 = DB::table('time_zones')->where('id', $tt)->first();
                $st        = ($student != null && $student->timezone != null) ? $student->timezone : '195';
                $timezone  = DB::table('time_zones')->where('id', $st)->first();
                $timesx     = $check->start_time;

                $tz        = $timezone->timezone;

                $t1        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t1->setTimezone(new \DateTimeZone($tz));
                $times     = $t1->format("Y-m-d h:i A");

                $t2        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t2->setTimezone(new \DateTimeZone($timezone1->timezone));
                $times2    = $t2->format("Y-m-d h:i A");

                $startTime = date('Y-m-d', (strtotime($times))) . 'T' . date('H:i:s', (strtotime($times)));

                $headers   = array("content-type: application/json", "Authorization:" . $merithub->merithub_token);


                if (empty($t_user->mh_user_id)) {
                    $url    = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";
                    $data   = array(
                        "name" => $t_user->name,
                        "img" => $tutor_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $t_user->id,
                        "email" => $t_user->email,
                        "role" => "M",
                        "timeZoneId" => $timezone1->timezone,
                        "permission" => "CJ"
                    );

                    $post_data  = json_encode($data);

                    $curl       = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    $result = curl_exec($curl);
                    curl_close($curl);

                    $getUserId      = json_decode($result);
                    $mh_user_id     = $getUserId->userId;
                    $update         = DB::table('users')->where('id', $t_user->id)->update(['mh_user_id' => $mh_user_id]);
                } else {
                    $mh_user_id = $t_user->mh_user_id;

                    $this->meritHubUserUpdate($merithub->client_id, $mh_user_id, $tutor_img, $timezone1->timezone, $t_user, $headers);
                    // die('end');
                }

                if (empty($s_user->mh_user_id)) {
                    // dd($merithub->client_id);
                    $url2   = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";

                    $data2  = array(
                        "name" => $s_user->name,
                        "img" => $student_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $s_user->id,
                        "email" => $s_user->email,
                        "role" => "M",
                        "timeZoneId" => $timezone->timezone,
                        "permission" => "CJ"
                    );

                    $post_data2 = json_encode($data2);

                    $curl2      = curl_init($url2);
                    curl_setopt($curl2, CURLOPT_URL, $url2);
                    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl2, CURLOPT_POST, 1);
                    curl_setopt($curl2, CURLOPT_POSTFIELDS, $post_data2);
                    curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
                    $result2 = curl_exec($curl2);
                    curl_close($curl2);

                    $getUserId2  = json_decode($result2);
                    // dd($getUserId2);
                    $mh_user_id2 = $getUserId2->userId;
                    $update      = DB::table('users')->where('id', $s_user->id)->update(['mh_user_id' => $mh_user_id2]);
                } else {
                    $mh_user_id2 = $s_user->mh_user_id;

                    $this->meritHubUserUpdate($merithub->client_id, $mh_user_id2, $student_img, $timezone->timezone, $s_user, $headers);
                }

                // Schedule Class CURL
                $url1     = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $mh_user_id . "";

                $data1 = array(
                    "title" => $s_user->name . ' ' . 'Session',
                    "startTime" => $startTime,
                    "recordingDownload" => false,
                    "downloadRecording" => false,
                    "duration" => $check->duration,
                    "lang" => "en",
                    "timeZoneId" => $timezone->timezone,
                    "type" => "oneTime",
                    "access" => "private",
                    "login" => false,
                    "layout" => "CR",
                    "status" => "up",
                    "recording" => array("record" => false, "autoRecord" => false, "recordingControl" => true)
                );

                $post_data1 = json_encode($data1);
                $curl1 = curl_init($url1);
                curl_setopt($curl1, CURLOPT_URL, $url1);
                curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl1, CURLOPT_POST, 1);
                curl_setopt($curl1, CURLOPT_POSTFIELDS, $post_data1);
                curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
                $result1 = curl_exec($curl1);
                curl_close($curl1);

                $getClass = json_decode($result1);
                // dd($getClass);
                $classId               = $getClass->classId;
                $TutorJoinLink         = $getClass->hostLink;
                $commonParticipantLink = $getClass->commonLinks->commonParticipantLink;
                // End Schedule Class CURL

                $url3       = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $classId . "/users";
                $data3      = array("users" => array(array("userId" => $mh_user_id2, "userLink" => $commonParticipantLink, "userType" => "su", "timeZoneId" => $timezone1->timezone,)));
                $post_data3 = json_encode($data3);

                $curl3      = curl_init($url3);
                curl_setopt($curl3, CURLOPT_URL, $url3);
                curl_setopt($curl3, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl3, CURLOPT_POST, 1);
                curl_setopt($curl3, CURLOPT_POSTFIELDS, $post_data3);
                curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
                $result3 = curl_exec($curl3);
                curl_close($curl3);
                $getSession = json_decode($result3);
                $StudentJoinLink = $getSession[0]->userLink;

                $TutorJoinLink   = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $TutorJoinLink;
                $StudentJoinLink = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $StudentJoinLink;
                $RecordingURL    = "https://merithub.com/" . $merithub->client_id . "/sessions/view/" . $classId . "/" . $commonParticipantLink;
                // End MerihHub Integration

                //Decrease credit
                Credit::where(['student_id' => auth()->user()->id, 'teacher_id' => $check->teacher_id])->decrement('credit', 1);

                // Update book Session
                $check->student_url = $StudentJoinLink;
                $check->teacher_url = $TutorJoinLink;
                $check->record_url  = $RecordingURL;
                $check->is_booked   = 1;
                $check->save();

                $class_details = DB::table('categories')->where('id', $check->class_id)->first();
                // Email for student
                $email =
                    [
                        'sender_email' => $s_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        's_name' => $s_user->name,
                        't_name' => $t_user->name,
                        'title' => 'Student Class Booking Email',
                        'class_time' => $times,
                        'class_name' => $class_details->name,
                    ];

                Mail::send('mail.student-reschedule', $email, function ($messages) use ($email) {
                    $messages->to($email['sender_email'])
                        ->from($email['inext_email'], 'Know-merit');
                    $messages->subject("Successful Reschedule - Get Ready for a New Learning Adventure!");
                });

                // Email for Teacher
                $email2 =
                    [
                        'sender_email' => $t_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        't_name' => $t_user->name,
                        's_name' => $s_user->name,
                        'title' => 'Successfully Registered!',
                        'class_time' => $times2,
                        'class_name' => $class_details->name,

                    ];

                Mail::send('mail.teacher-reschedule', $email2, function ($messages) use ($email2) {
                    $messages->to($email2['sender_email'])
                        ->from($email2['inext_email'], 'Know-merit');
                    $messages->subject("Successful Reschedule - Get Ready for a New Learning Adventure!");
                });

                DB::commit();
                return redirect()->route('student.student-dashboard')->with('success', 'Class created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                echo '<b>ERROR : </b>' . $e; //$e->getMessage()
                die;
            }
        } else {
            return redirect()->route('student.student-dashboard')->with('error', 'Oops something went wrong');
        }
    }
    public function session_view()
    {
        if(!Auth::check()){
            Session::put('contact','not login');
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'success1' => true
            ]);
        }
    }

    public function session_views(Request $request)
    {
        $id = $request->active;
        if(!Auth::check()){
            Session::put('ct_id',$id);
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'success2' => true
            ]);
        }
    }
}
