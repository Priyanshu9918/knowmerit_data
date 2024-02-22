<?php

namespace App\Http\Controllers\admin;

use App\Models\Tutor;
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
use App\Models\User;

// use App\Models\LanguageList;

class TutorController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $role = DB::table('users')
            ->join('tutors', 'users.id', '=', 'tutors.user_id')
            ->select('tutors.*', 'users.name','users.email','users.phone','users.first_name','users.id as uid','users.status as us_id')
            ->where('users.user_type',2)
            ->orderBy('id','DESC')
            ->get();

            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })
            ->addColumn('action', function($row) {
                $action_1 = '';
                if($row->us_id==0)
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->uid).'" data-id="'.base64_encode($row->uid).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->uid).'" data-id="'.base64_encode($row->uid).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    //dd($action_1);
                }
                else
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->uid).'" data-id="'.base64_encode($row->uid).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->uid).'" data-id="'.base64_encode($row->uid).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                }

                $edit_url = url('/admin/teacher/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                // $quiz = url('admin/question-list',['id'=>base64_encode($row->uid)]);

                // $action_ji = '<a href="'.$quiz.'" class="btn btn-sm btn-clean btn-icon" title="Quiz Generator"><i class="fas fa-plus text-info"></i></a>';





                $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                data-bs-toggle="tooltip" data-placement="top" title=""
                data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->uid).'">
                <i class="fas fa-trash text-danger"></i>
            </a>';

            $course_url = url('/admin/view-course',['id'=>base64_encode($row->uid)]);

            $action_4 = '<a href="'.$course_url.'" class="btn btn-sm btn-clean btn-icon" title="Course Assign"><i class="fa-solid fa-address-book"></i></a>';

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                    '.$action_2.'
                                    '.$action_3.'
                                    '.$action_4.'
                                </div>
                            </div>';
                return $action;
            })

            ->addColumn('featured', function($row) {
                $action_1 = '';
                if($row->is_featured==0)
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-toggle-off" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-toggle-on" style="color:green;"></i>                                        </span>
                                    </a>';
                    //dd($action_1);
                }
                else
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-toggle-off" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-toggle-on" style="color:green;"></i>                                        </span>
                                    </a>';
                }

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                 </div>
                            </div>';
                return $action;
            })
            ->addColumn('verified', function($row) {
                $action_1 = '';
                if($row->is_verified==0)
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn1"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fa fa-check-circle" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn1 d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fa fa-check-circle" style="color:green;"></i>                                        </span>
                                    </a>';
                    // dd($action_1);
                }
                else
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn1 d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fa fa-check-circle" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn1"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fa fa-check-circle" style="color:green;"></i>                                        </span>
                                    </a>';
                }

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                 </div>
                            </div>';
                return $action;
            });
            $datatables = $datatables->rawColumns(['check', 'action','featured','verified'])->make(true);

            return $datatables;
        }
        return view('admin.tutor.index');
    }
public function Indivisual(Request $request)
{
    if ($request->isMethod('get')) {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        return view('admin.tutor.create',compact('parent_categories','list_langauge'));

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
            'tutor_name' => 'required',
            'tutor_email' => 'required|email|unique:users,email',
            'tutor_location' => 'required',
            'category' => 'required',
            // 'sub_category' => 'required',
           // 'tutor_subject_teach' => 'required',
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
          if($request->bnft == 2){

                if ($request->file('image')) {
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
            $user->name = $request->tutor_name;
            $user->email = $request->tutor_email;
            $user->phone = $request->tutor_mobile;
            $user->first_name = $request->tutor_name;
            $user->password = Hash::make($request->password);
            $user->avatar =!empty($final_image_name) ? $final_image_name : NULL;
            $user->user_type = 2;
            $user->status = 1;
            // dd($user);
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
                    'youtube_url' => $request->input('youtube_url'),
                    'teaching_experience' => $request->input('teaching_experience'),
                    // 'experience_year' => $request->input('experience_year'),
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
                // DB::table('tutors')->insert($data);
                DB::table('tutors')->insertGetId($data);

                DB::commit();
                return response()->json([
                    'success' => true
                ]);
            }


    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return $e;
    }
}


public function Institute(Request $request)
{
    if ($request->isMethod('get')) {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        return view('admin.tutor.institute',compact('parent_categories','list_langauge'));

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
            'tutor_name' => 'required',
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
                // 'parent_id' =>implode(",", $request->input('tutor_subject_teach')),
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'status' => 1,
                'c_code' => preg_replace('/[^0-9]/', '', strstr($request->c_code, '+')),
                'language' =>implode(",", $request->input('language')),
                'backgorund_experience' => $request->input('backgorund_experience'),
                'degree' => $request->input('degree'),
                'charge_amount' => $request->input('charge_amount'),
                'university_name' => $request->input('university_name'),
                'institute_name' => $request->input('institute_name'),
                'degree_status' => $request->input('degree_status'),
                'school_board' =>implode(",", $request->input('school_board')),
                'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                'youtube_url' => $request->input('youtube_url'),
                'teaching_experience' => $request->input('teaching_experience'),
                // 'experience_year' => $request->input('experience_year'),
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
//teacher
public function razorPaySuccess3(Request $request) {
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
    $bill_details->youtube_url = $request->youtube_url ?? '';
    $bill_details->teaching_experience = $request->teaching_experience ?? '';
    // $bill_details->experience_year = $request->experience_year ?? '';
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
    $bill_details->payment_status = $request->payment_status ?? '';
    $bill_details->status = 1;
    $bill_details->r_payment_id = $request->payment_id ?? '';
    $bill_details->amount = $request->amount ?? '';
    $orderCount = Tutor::count() + 1;
    $bill_details->order_number = 'KM' .  date('ymdhis') . $orderCount;
    // dd($bill_details);
    $bill_details->save();
    // if (isset($bill_details)) {
    //     $data = [
    //         'user_id' => $ur_id,
    //         'r_payment_id' => $request->payment_id,
    //         'amount' => $request->amount,
    //     ];

    //     $getId = DB::table('payments')->insertGetId($data);
    //     return view('admin.tutor.index');
    //     $arr = ['msg' => 'Payment successfully credited', 'status' => true];
    // }
    return view('admin.tutor.index');
    // return response()->json($arr);
}


public function razorPaySuccess4(Request $request) {
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
    $bill_details->tutor_type = 'institute';
    $bill_details->name = $request->name ?? '';
    $bill_details->email = $request->email ?? '';
    $bill_details->mobile = $request->mobile ?? '';
    $bill_details->location = $request->location ?? '';
    $bill_details->lng = $request->lng ?? '';
    $bill_details->lat = $request->lat ?? '';
    // $bill_details->gender = $request->gender ?? '';
    $bill_details->category = $request->category ?? '';
    $bill_details->sub_category = $request->sub_category ?? '';
    $bill_details->parent_id = $request->category ?? '';
    $bill_details->image = !empty($final_image_name) ? $final_image_name:NULL;
    $bill_details->c_code = $coun_code;
    $bill_details->language = $request->language ?? '';
    $bill_details->backgorund_experience = $request->backgorund_experience ?? '';
    $bill_details->degree = $request->degree ?? '';
    $bill_details->institute_name = $request->institute_name ?? '';
    $bill_details->university_name = $request->university_name ?? '';
    $bill_details->degree_status = $request->degree_status ?? '';
    $bill_details->school_board = $request->school_board ?? '';
    $bill_details->conduct_mode_class = $request->conduct_mode_class ?? '';
    $bill_details->youtube_url = $request->youtube_url ?? '';
    $bill_details->teaching_experience = $request->teaching_experience ?? '';
    // $bill_details->experience_year = $request->experience_year ?? '';
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
    $bill_details->payment_status = $request->payment_status ?? '';
    $bill_details->status = 1;
    $bill_details->r_payment_id = $request->payment_id ?? '';
    $bill_details->amount = $request->amount ?? '';
    $orderCount = Tutor::count() + 1;
    $bill_details->order_number = 'KM' .  date('ymdhis') . $orderCount;
    // dd($bill_details);
    $bill_details->save();
    // if (isset($bill_details)) {
    //     $data = [
    //         'user_id' => $ur_id,
    //         'r_payment_id' => $request->payment_id,
    //         'amount' => $request->amount,
    //     ];

    //     $getId = DB::table('payments')->insertGetId($data);
    //     return view('admin.tutor.index');
    //     $arr = ['msg' => 'Payment successfully credited', 'status' => true];
    // }
    return view('admin.tutor.index');
    // return response()->json($arr);
}



public function edit(Request $request)
{
    $tutor_id = base64_decode($request->id);

    if($request->isMethod('get'))
    {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        // $tutor = DB::table('users')
        //     ->join('tutors', 'users.id', '=', 'tutors.user_id')
        //     ->select('tutors.*')
        //     ->where('users.id',$tutor_id)
        //     ->first();
        //     dd($tutor);
        $tutor  = DB::table('tutors')->where('id',$tutor_id)->first();
        $p_code =DB::table('countries')->where('phonecode',$tutor->c_code)->first();
        $iso = $p_code->sortname;
        if($tutor->tutor_type == 'individual'){
            return view('admin.tutor.edit' ,compact('tutor','list_langauge','parent_categories','iso'));
        }else{
            return view('admin.tutor.edit-institute' ,compact('tutor','list_langauge','parent_categories','iso'));
        }
    }
     $tutor1  = DB::table('tutors')->where('id',$tutor_id)->first();
    if ($tutor1 !== null && $tutor1->tutor_type == 'individual'){
        $rules = [
            'tutor_name' => 'required',
            'tutor_email' => 'required|email',
            'tutor_location' => 'required',
            'category' => 'required',
            'tutor_gender' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            'c_code' => 'required',
            'tutor_mobile' => 'required',
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
            'describe_experience' => 'required'
        ];
    }
    else{
        $rules = [
            'institute_name' => 'required',
            'tutor_name' => 'required',
            'tutor_email' => 'required|email',
            'tutor_location' => 'required',
            'category' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            'c_code' => 'required',
            'tutor_mobile' => 'required',
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
        ];
    }

    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {

        return response()->json([
            'success' => false,
            'errors' => $validation->errors()
        ]);

    }


    DB::beginTransaction();
    try{
        $tutor  = DB::table('tutors')->where('id',$tutor_id)->first();
        if($tutor !== null &&  $tutor->tutor_type == 'individual'){
            if ($request->file('image')) {

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
            } else {
                $final_image_name = $tutor->image;
            }

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
                    'name' => $request->input('tutor_name'),
                    'email' => $request->input('tutor_email'),
                    'mobile' => $request->input('tutor_mobile'),
                    'location' => $request->input('tutor_location'),
                    'lng' => $request->input('lng'),
                    'lat' => $request->input('lat'),
                    // 'gender' => $request->input('tutor_gender'),
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
                    'youtube_url' => $request->input('youtube_url'),
                    'teaching_experience' => $request->input('teaching_experience'),
                    'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                    'describe_experience' => $request->input('describe_experience'),
                    'all_state_subject' => $all_state_subject ?? null,
                    'state_board' => $all_state_board ?? null,
                    'cbse_subject' =>$all_cbse_subject ?? null,
                    'icse_subject' =>$all_icse_subject  ?? null,
                    'igcse_subject' => $all_igcse_subjec ?? null,
                    'international_subject' => $all_inter_subject ?? null,
                    'nios_subject' =>  $all_nios_subject ?? null,
                    'payment_status' => $request->input('payment_status'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            $data1 = [
                'first_name' => $request->input('tutor_name'),
                'name' => $request->input('tutor_name'),
                'phone' => $request->input('tutor_mobile'),
                'avatar'=>!empty($final_image_name) ? $final_image_name : NULL,
            ];
        }else{
            if ($request->file('image')) {

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
            } else {
                $final_image_name = $tutor->image;
            }

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
                    'name' => $request->input('tutor_name'),
                    'email' => $request->input('tutor_email'),
                    'mobile' => $request->input('tutor_mobile'),
                    'location' => $request->input('tutor_location'),
                    'institute_name' => $request->input('institute_name'),
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
                    'university_name' => $request->input('university_name'),
                    'degree_status' => $request->input('degree_status'),
                    'youtube_url' => $request->input('youtube_url'),
                    'school_board' =>implode(",", $request->input('school_board')),
                    'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                    'teaching_experience' => $request->input('teaching_experience'),
                    'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                    'describe_experience' => $request->input('describe_experience'),
                    'all_state_subject' => $all_state_subject ?? null,
                    'state_board' => $all_state_board ?? null,
                    'cbse_subject' =>$all_cbse_subject ?? null,
                    'icse_subject' =>$all_icse_subject  ?? null,
                    'igcse_subject' => $all_igcse_subjec ?? null,
                    'international_subject' => $all_inter_subject ?? null,
                    'nios_subject' =>  $all_nios_subject ?? null,
                    'payment_status' => $request->input('payment_status'),
                    'updated_at' => date('Y-m-d H:i:s')

           ];
            $data1 = [
                'name' => $request->input('tutor_name'),
                'first_name' => $request->input('tutor_name'),
                'phone' => $request->input('tutor_mobile'),
                'avatar'=>!empty($final_image_name) ? $final_image_name : NULL,
            ];
        }

        DB::table('users')->where('id',$tutor1->user_id)->update($data1);
        DB::table('tutors')->where('id',$tutor_id)->update($data);

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



public function subCategoryList1(Request $request)
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
public function subCategoryListEdit1(Request $request)
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

}
