<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Tutor;
use App\Helpers\Helper;
use App\Models\User;
use App\Mail\TeacherMail;
use App\Mail\TeacherMailSupport;
use App\Mail\TeacherPaymentMail;
use Mail;
// use App\Models\LanguageList;

class TutorController extends Controller
{
public function createIndivisual(Request $request)
{
    if ($request->isMethod('get')) {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        return view('front.create-teacher',compact('parent_categories','list_langauge'));

          }
        //   dd($request->all());

        $rules = [
            'password' => [
                'required',
                // 'string',
                // 'min:10',             // must be at least 10 characters in length
                // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                // 'regex:/[A-Z]/',      // must contain at least one uppercase letter
                // 'regex:/[0-9]/',      // must contain at least one digit
                // 'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'tutor_name' => 'required|regex:/^[A-Za-z ]+$/',
            'tutor_email' => 'required|email|unique:users,email',
            'tutor_location' => 'required',
            'category' => 'required',
            'tutor_gender' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            // 'c_code' => 'required',
            'tutor_mobile' => 'required',
            // 'parent_id' => 'required',
            'language' => 'required',
            'backgorund_experience' => 'required',
            'degree' => 'required',
            'university_name' => 'required',
            'degree_status' => 'required',
            'school_board' => 'required',
            'conduct_mode_class' => 'required',
            'teaching_experience' => 'required',
            // 'experience_year' => 'required',
            // 'classes_mode' => 'required',
            'charge_amount' => 'required',
            'describe_experience' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'
        ];
        if(in_array('ICSE', $request->input('school_board', []))){
            $rules['all_icse_subject'] = 'required';
        }
        if(in_array('CBSE', $request->input('school_board', []))){
            $rules['all_cbse_subject'] = 'required';
        }
        if(in_array('State', $request->input('school_board', []))){
            $rules['all_state_subject'] = 'required';
            $rules['all_state_board'] = 'required';
        }
        if(in_array('International', $request->input('school_board', []))){
            $rules['all_inter_subject'] = 'required';
        }
        // if(in_array('IGCSE', $request->input('school_board', []))){
        //     $rules['all_state_board'] = 'required';
        // }
        if(in_array('NIOS', $request->input('school_board', []))){
            $rules['all_nios_subject'] = 'required';
        }



    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {

        return response()->json([
            'success' => false,
            'errors' => $validation->errors()
        ]);
    }
    DB::beginTransaction();
    try {
          if($request->bnft == 2)
          {
                if ($request->file('image'))
                {
                    $image = $request->file('image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/tutors/');
                    if (!File::exists($destination_path)) {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path, $final_image_name);
                }
            $user = new User;
            $user->first_name = $request->tutor_name;
            $user->name = $request->tutor_name;
            $user->email = $request->tutor_email;
            $user->phone = $request->tutor_mobile;
            $user->password = Hash::make($request->password);
            $user->avatar =!empty($final_image_name) ? $final_image_name : NULL;
            $user->user_type = 2;
            $user->status = 1;
            $user->save();
            // $ur_id = DB::table('users')->insertGetId($user);

            if($request->input('all_state_subject') != null){
                $all_state_subject = implode(",", $request->input('all_state_subject'));
            }
            if($request->input('all_state_board') != null){
                $all_state_board = implode(",", $request->input('all_state_board'));
            }
            if($request->input('all_cbse_subject') != null){
                $all_cbse_subject = implode(",", $request->input('all_cbse_subject'));
            }
            if($request->input('all_icse_subject') != null){
                $all_icse_subject = implode(",", $request->input('all_icse_subject'));
            }
            if($request->input('all_inter_subject') != null){
                $all_inter_subject = implode(",", $request->input('all_inter_subject'));
            }
            if($request->input('all_nios_subject') != null){
                $all_nios_subject = implode(",", $request->input('all_nios_subject'));
            }
            if($request->input('all_igcse_subject') != null){
                $all_igcse_subject = implode(",", $request->input('all_igcse_subject'));
            }

                $data = [
                    // 'user_id' => $ur_id,
                    'user_id' => $user->id,
                    'tutor_type'=>'individual',
                    'name' => $request->input('tutor_name'),
                    'email' => $request->input('tutor_email'),
                    'mobile' => $request->input('tutor_mobile'),
                    'location' => $request->input('tutor_location'),
                    'lng' => $request->input('lng'),
                    'lat' => $request->input('lat'),
                    'gender' => $request->input('tutor_gender'),
                    'parent_id' => implode(",", $request->input('category')),
                    'category' => implode(",", $request->input('category')),
                    'sub_category' => $request->has('sub_category') ? implode(",", $request->input('sub_category')) : '',
                    'image' => !empty($final_image_name) ? $final_image_name : NULL,
                    'status' => 1,
                    'c_code' => preg_replace('/[^0-9]/', '', strstr($request->c_code, '+')),
                    'language' =>implode(",", $request->input('language')),
                    'backgorund_experience' => $request->input('backgorund_experience'),
                    'degree' => $request->input('degree'),
                    'charge_amount' => $request->input('charge_amount'),
                    'university_name' => $request->input('university_name'),
                    'degree_status' => $request->input('degree_status'),
                    'school_board' =>implode(",", $request->input('school_board')),
                    'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                    // 'tutor_travel' => $request->input('tutor_travel'),
                    'teaching_experience' => $request->input('teaching_experience'),
                    'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                    'youtube_url' => $request->input('youtube_url'),
                    'describe_experience' => $request->input('describe_experience'),
                    'all_state_subject' => $all_state_subject ?? null,
                    'state_board' => $all_state_board ?? null,
                    'cbse_subject' =>$all_cbse_subject ?? null,
                    'icse_subject' =>$all_icse_subject  ?? null,
                    'igcse_subject' => $all_igcse_subjec ?? null,
                    'international_subject' => $all_inter_subject ?? null,
                    'nios_subject' =>  $all_nios_subject ?? null,
                    'payment_status' => $request->input('payment_status'),
                    'created_at' =>date('Y-m-d H:i:s'),
                ];
                // DB::table('tutors')->insert($data);
                DB::table('tutors')->insertGetId($data);
                $aa = Session::put('ist_id' , $data);
                mail::to($user->email)->send(new TeacherMail($data));
                mail::to('support@knowmerit.com')->send(new TeacherMailSupport($data));
                $user = User::where(['email' => $user->email])->where('user_type', 2)->latest()->first(); //,'user_type'=>'1'
                // dd($bill_details);
                if ($user) {
                    Auth::loginUsingId($user->id);
                    DB::commit();
                    return response()->json([
                        'success' => true
                    ]);
                }

            }


    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return $e;
    }
}


public function createInstitute(Request $request)
{
    if ($request->isMethod('get')) {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        return view('front.create-institute',compact('parent_categories','list_langauge'));

    }
        $rules = [
            'password' => [
                'required',
                // 'string',
                // 'min:10',             // must be at least 10 characters in length
                // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                // 'regex:/[A-Z]/',      // must contain at least one uppercase letter
                // 'regex:/[0-9]/',      // must contain at least one digit
                // 'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'tutor_name' => 'required|regex:/^[A-Za-z ]+$/',
            'tutor_email' => 'required|email|unique:users,email',
            'tutor_location' => 'required',
            'category' => 'required',
            // 'tutor_gender' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            // 'c_code' => 'required',
            'tutor_mobile' => 'required',
            // 'parent_id' => 'required',
            'language' => 'required',
            'backgorund_experience' => 'required',
            'degree' => 'required',
            'institute_name' => 'required',
            'degree_status' => 'required',
            'school_board' => 'required',
            'conduct_mode_class' => 'required',
            'teaching_experience' => 'required',
            // 'experience_year' => 'required',
            // 'classes_mode' => 'required',
            'charge_amount' => 'required|numeric',
            'describe_experience' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'
        ];
        if(in_array('ICSE', $request->input('school_board', []))){
            $rules['all_icse_subject'] = 'required';
        }
        if(in_array('CBSE', $request->input('school_board', []))){
            $rules['all_cbse_subject'] = 'required';
        }
        if(in_array('State', $request->input('school_board', []))){
            $rules['all_state_subject'] = 'required';
            $rules['all_state_board'] = 'required';
        }
        if(in_array('International', $request->input('school_board', []))){
            $rules['all_inter_subject'] = 'required';
        }
        // if(in_array('IGCSE', $request->input('school_board', []))){
        //     $rules['all_state_board'] = 'required';
        // }
        if(in_array('NIOS', $request->input('school_board', []))){
            $rules['all_nios_subject'] = 'required';
        }

    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {

        return response()->json([
            'success' => false,
            'errors' => $validation->errors()
        ]);
    }
    DB::beginTransaction();
    try {
        if($request->bnft == 2)
        {
            if ($request->file('image'))
            {
                  $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/tutors/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            }

            $user = new User;
            $user->first_name = $request->tutor_name;
            $user->name = $request->tutor_name;
            $user->email = $request->tutor_email;
            $user->phone = $request->tutor_mobile;
            $user->avatar =!empty($final_image_name) ? $final_image_name : NULL;
            $user->password = Hash::make($request->password);
            $user->user_type = 2;
            $user->status = 1;
            $user->save();
            if($request->input('all_state_subject') != null){
                $all_state_subject = implode(",", $request->input('all_state_subject'));
            }
            if($request->input('all_state_board') != null){
                $all_state_board = implode(",", $request->input('all_state_board'));
            }
            if($request->input('all_cbse_subject') != null){
                $all_cbse_subject = implode(",", $request->input('all_cbse_subject'));
            }
            if($request->input('all_icse_subject') != null){
                $all_icse_subject = implode(",", $request->input('all_icse_subject'));
            }
            if($request->input('all_inter_subject') != null){
                $all_inter_subject = implode(",", $request->input('all_inter_subject'));
            }
            if($request->input('all_nios_subject') != null){
                $all_nios_subject = implode(",", $request->input('all_nios_subject'));
            }
            if($request->input('all_igcse_subject') != null){
                $all_igcse_subject = implode(",", $request->input('all_igcse_subject'));
            }
            $data = [
                'user_id' => $user->id,
                'tutor_type'=>'institute',
                'name' => $request->input('tutor_name'),
                'email' => $request->input('tutor_email'),
                'mobile' => $request->input('tutor_mobile'),
                'location' => $request->input('tutor_location'),
                // 'gender' => $request->input('tutor_gender'),
                'lng' => $request->input('lng'),
                'lat' => $request->input('lat'),
                'parent_id' => implode(",", $request->input('category')),
                'category' => implode(",", $request->input('category')),
                'sub_category' => $request->has('sub_category') ? implode(",", $request->input('sub_category')) : '',
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'status' => 1,
                'c_code' => preg_replace('/[^0-9]/', '', strstr($request->c_code, '+')),
                'language' =>implode(",", $request->input('language')),
                'backgorund_experience' => $request->input('backgorund_experience'),
                'degree' => $request->input('degree'),
                'charge_amount' => $request->input('charge_amount'),
                'institute_name' => $request->input('institute_name'),
                'university_name' => $request->input('university_name'),
                'degree_status' => $request->input('degree_status'),
                'school_board' =>implode(",", $request->input('school_board')),
                'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                // 'tutor_travel' => $request->input('tutor_travel'),
                'teaching_experience' => $request->input('teaching_experience'),
                'youtube_url' => $request->input('youtube_url'),
                'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                'describe_experience' => $request->input('describe_experience'),
                // 'classes_mode' => implode(",", $request->input('classes_mode')),
                'all_state_subject' => $all_state_subject ?? null,
                'state_board' => $all_state_board ?? null,
                'cbse_subject' =>$all_cbse_subject ?? null,
                'icse_subject' =>$all_icse_subject  ?? null,
                'igcse_subject' => $all_igcse_subjec ?? null,
                'international_subject' => $all_inter_subject ?? null,
                'nios_subject' =>  $all_nios_subject ?? null,
                'payment_status' => $request->input('payment_status'),
                'created_at' =>date('Y-m-d H:i:s'),
            ];
            // dd($data);

        DB::table('tutors')->insertGetId($data);
        $aa = Session::put('ist_id' , $data);
        mail::to($user->email)->send(new TeacherMail($data));
        mail::to('support@knowmerit.com')->send(new TeacherMailSupport($data));
        $user = User::where(['email' => $user->email])->where('user_type', 2)->latest()->first(); //,'user_type'=>'1'
        // dd($bill_details);
            if ($user) {
                Auth::loginUsingId($user->id);
                DB::commit();
                return response()->json([
                    'success' => true
                ]);
            }

        }
    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return $e;
    }
}
//teacher
public function razorPaySuccess1(Request $request) {
    // dd($request->all());

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $date = date('YmdHis');
        $random_no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
        $random_no = substr($random_no, 0, 2);
        $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

        $destination_path = public_path('/uploads/tutors/');
        if (!File::exists($destination_path)) {
            File::makeDirectory($destination_path, 0777, true, true);
        }
        $image->move($destination_path, $final_image_name);
    } else {
        $final_image_name = null;
        }

    // dd($coun_code);
    $hashed_random_password = Hash::make($request->input('password'));
    $dataruser = [
        'first_name'=>$request->input('name'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('mobile'),
        'avatar' =>!empty($final_image_name) ? $final_image_name : NULL,
        'user_type' => 2,
        'password' => $hashed_random_password,
        'status' =>1,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $ur_id = DB::table('users')->insertGetId($dataruser);

    $coun_code = $request->c_code;
    preg_match_all('/\d+/', $coun_code, $matches);
    $coun_code = implode('', $matches[0]);

    $bill_details = new Tutor;
    $bill_details->user_id = $ur_id;
    $bill_details->tutor_type = 'individual';
    $bill_details->name = $request->name ?? '';
    $bill_details->email = $request->email ?? '';
    $bill_details->mobile = $request->mobile ?? '';
    $bill_details->location = $request->location ?? '';
    $bill_details->lng = $request->lng ?? '';
    $bill_details->lat = $request->lat ?? '';
    $bill_details->gender = $request->gender ?? '';
    $bill_details->category = $request->category ?? '';
    $bill_details->sub_category = $request->sub_category ?? '';
    $bill_details->parent_id = $request->category ?? '';
    $bill_details->image = !empty($final_image_name) ? $final_image_name:NULL;
    $bill_details->c_code = $coun_code;
    $bill_details->language = $request->language ?? '';
    $bill_details->backgorund_experience = $request->backgorund_experience ?? '';
    $bill_details->degree = $request->degree ?? '';
    $bill_details->university_name = $request->university_name ?? '';
    $bill_details->degree_status = $request->degree_status ?? '';
    $bill_details->school_board = $request->school_board ?? '';
    $bill_details->conduct_mode_class = $request->conduct_mode_class ?? '';
    // $bill_details->tutor_travel = $request->tutor_travel ?? '';
    $bill_details->teaching_experience = $request->teaching_experience ?? '';
    $bill_details->youtube_url = $request->youtube_url ?? '';
    $bill_details->experience_year = $request->teaching_experience === 'No' ? null : $request->experience_year;
    $bill_details->describe_experience = $request->describe_experience ?? '';
    // $bill_details->classes_mode = $request->classes_mode ?? '';
    $bill_details->all_state_subject = $request->all_state_subject ?? '';
    $bill_details->state_board = $request->all_state_board ?? '';
    $bill_details->cbse_subject = $request->all_cbse_subject ?? '';
    $bill_details->icse_subject = $request->all_icse_subject ?? '';
    $bill_details->igcse_subject = $request->all_igcse_subject ?? '';
    $bill_details->international_subject = $request->all_inter_subject ?? '';
    $bill_details->nios_subject = $request->all_nios_subject ?? '';
    $bill_details->charge_amount = $request->charge_amount ?? '';
    $bill_details->r_payment_id = $request->payment_id ?? '';
    $bill_details->amount = $request->amount ?? '';
    $bill_details->payment_status = $request->payment_status ?? '';
    $bill_details->status = 1;
    $orderCount = tutor::count() + 1;
    $bill_details->order_number = 'KM' .  date('ymdhis') . $orderCount;
    // dd($bill_details);
    $bill_details->save();
    $data=[
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('mobile'),
        'university_name' => $request->input('university_name'),
        'created_at' => date('Y-m-d H:i:s')
    ];

    Mail::to($bill_details->email)->send(new TeacherPaymentMail($bill_details));
    Mail::to($bill_details->email)->send(new TeacherMail($data));
    mail::to('support@knowmerit.com')->send(new TeacherMailSupport($data));
    $bill_details = User::where(['email' => $bill_details->email])->where('user_type', 2)->latest()->first(); //,'user_type'=>'1'
  // dd($bill_details);
    if ($bill_details) {
        Auth::loginUsingId($bill_details->id);
        DB::commit();
        return redirect('teacher/teacher-instructor-dashboard');
    }
    }


    public function razorPaySuccess2(Request $request) {
    // dd($request->all());
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $date = date('YmdHis');
        $random_no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
        $random_no = substr($random_no, 0, 2);
        $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

        $destination_path = public_path('/uploads/tutors/');
        if (!File::exists($destination_path)) {
            File::makeDirectory($destination_path, 0777, true, true);
        }
        $image->move($destination_path, $final_image_name);
    } else {
        $final_image_name = null;
        }

    $hashed_random_password = Hash::make($request->input('password'));
    $dataruser = [
        'first_name'=>$request->input('name'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('mobile'),
        'avatar' =>!empty($final_image_name) ? $final_image_name : NULL,
        'user_type' => 2,
        'password' => $hashed_random_password,
        'status' =>1,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $ur_id = DB::table('users')->insertGetId($dataruser);


         $coun_code = $request->c_code;
        preg_match_all('/\d+/', $coun_code, $matches);
        $coun_code = implode('', $matches[0]);

        // dd($coun_code);
    $bill_details = new Tutor;
    $bill_details->user_id = $ur_id;
    $bill_details->tutor_type = 'institute';
    $bill_details->name = $request->name ?? '';
    $bill_details->email = $request->email ?? '';
    $bill_details->mobile = $request->mobile ?? '';
    $bill_details->location = $request->location ?? '';
    $bill_details->lng = $request->lng ?? '';
    $bill_details->lat = $request->lat ?? '';
    $bill_details->category = $request->category ?? '';
    $bill_details->sub_category = $request->sub_category ?? '';
    $bill_details->parent_id = $request->category ?? '';
    $bill_details->image = !empty($final_image_name) ? $final_image_name:NULL;
    $bill_details->c_code = $coun_code;
    $bill_details->language = $request->language ?? '';
    $bill_details->backgorund_experience = $request->backgorund_experience ?? '';
    $bill_details->degree = $request->degree ?? '';
    $bill_details->university_name = $request->university_name ?? '';
    $bill_details->institute_name = $request->institute_name ?? '';
    $bill_details->degree_status = $request->degree_status ?? '';
    $bill_details->school_board = $request->school_board ?? '';
    $bill_details->conduct_mode_class = $request->conduct_mode_class ?? '';
    // $bill_details->tutor_travel = $request->tutor_travel ?? '';
    $bill_details->teaching_experience = $request->teaching_experience ?? '';
    $bill_details->youtube_url = $request->youtube_url ?? '';
    $bill_details->experience_year = $request->teaching_experience === 'No' ? null : $request->experience_year;
    $bill_details->describe_experience = $request->describe_experience ?? '';
    // $bill_details->classes_mode = $request->classes_mode ?? '';
    $bill_details->all_state_subject = $request->all_state_subject ?? '';
    $bill_details->state_board = $request->all_state_board ?? '';
    $bill_details->cbse_subject = $request->all_cbse_subject ?? '';
    $bill_details->icse_subject = $request->all_icse_subject ?? '';
    $bill_details->igcse_subject = $request->all_igcse_subject ?? '';
    $bill_details->international_subject = $request->all_inter_subject ?? '';
    $bill_details->nios_subject = $request->all_nios_subject ?? '';
    $bill_details->charge_amount = $request->charge_amount ?? '';
    $bill_details->r_payment_id = $request->payment_id ?? '';
    $bill_details->amount = $request->amount ?? '';
    $bill_details->payment_status = $request->payment_status ?? '';
    $bill_details->status = 1;
    $orderCount = tutor::count() + 1;
    $bill_details->order_number = 'KM' .  date('ymdhis') . $orderCount;
    // dd($bill_details);
    $bill_details->save();
    // mail::to($bill_details->email)->send(new TeacherPaymentMail($bill_details));

    $data=[
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('mobile'),
        'university_name' => $request->input('university_name'),
        'created_at' => date('Y-m-d H:i:s')
    ];

    Mail::to($bill_details->email)->send(new TeacherPaymentMail($bill_details));
    Mail::to($bill_details->email)->send(new TeacherMail($data));
    mail::to('support@knowmerit.com')->send(new TeacherMailSupport($data));
    $bill_details = User::where(['email' => $bill_details->email])->where('user_type', 2)->latest()->first(); //,'user_type'=>'1'
    // dd($bill_details);
        if ($bill_details) {
            Auth::loginUsingId($bill_details->id);
            DB::commit();
            return redirect('teacher/teacher-instructor-dashboard');
        }
    // return response()->json($arr);
}




public function subCategoryList(Request $request)
{
    $category_id = $request->category;
//  dd($category_id);
    $sub_category = DB::table('categories')
    ->leftJoin('categories as c','categories.parent', '=','c.id')
    ->select('categories.id', 'categories.name', 'categories.parent','c.name as p_name')->whereIn('categories.parent', $category_id)->where('categories.status', 1)->get();
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
public function subCategoryListEdit(Request $request)
{
    $category_id = $request->category;
//  dd($category_id);
    $sub_category = DB::table('categories')
    ->leftJoin('categories as c','categories.parent', '=','c.id')
    ->select('categories.id', 'categories.name', 'categories.parent','c.name as p_name')->where('categories.parent', $category_id)->where('categories.status', 1)->get();
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


public function timezone2(Request $request)
{
    $id = Auth::user()->id;
    $con =  DB::table('users')->where('id', $id)->update([
        'country'    => $request->country2,
        'timezone'      => $request->timezone2,
    ]);

    DB::commit();
    return response()->json([
        'success' => true
    ]);

}

public function timezone3(Request $request)
{
    $id = Auth::user()->id;
    $con =  DB::table('users')->where('id', $id)->update([
        'country'    => $request->country3,
        'timezone'      => $request->timezone3,
    ]);

    DB::commit();
    return response()->json([
        'success' => true
    ]);

}
public function checkEmail(Request $request)
{
    $email = $request->input('email');

    $tutor = user::where('email', $email)->first();

    if ($tutor) {
        return response()->json(['exists' => true]);
    } else {
        return response()->json(['exists' => false]);
    }
}
public function jitsi(Request $request)
{
    return view('front.meeting-jitsi');
}
}
