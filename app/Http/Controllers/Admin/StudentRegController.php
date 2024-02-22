<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Book_a_class;
use App\Models\Student;
use App\Models\Credit;
class StudentRegController extends Controller
{
    public function index(Request $request)

    {
        if ($request->ajax()) {

            $games = DB::table('users')->where('user_type',3)->where('status','<>',2)->orderBy('id','DESC')
           ->get();
            // ->leftjoin('students', 'users.id', '=', 'students.user_id')
            // ->select('users.*', 'students.payment_status')
            // ->where('user_type',3)
            // ->get();
            // $games = DB::table('credits')->where('student_id', $user_id)->get();
            $datatables = Datatables::of($games)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })

                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $action_1 = '';
                    if ($row->status == 0) {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    } else {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    }


                    $edit_url = url('/admin/student_manegement_two/edit', ['id' => base64_encode($row->id)]);
                    $view_url = url('/admin/student_manegement_two/assign_teacher/view',['id'=>base64_encode($row->id)]);
                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                    data-bs-toggle="tooltip" data-placement="top" title=""
                    data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                    <i class="fas fa-trash text-danger"></i>
                    </a>';
                        $action_4 = '<a href="' . $view_url . '" class="btn btn-sm btn-clean btn-icon" title="Teacher Assign"><i class="fas fa-user text-info"></i></a>';


                           $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                ' . $action_1 . '
                                    ' . $action_2 . '
                                    ' . $action_3 . '
                                    ' . $action_4 . '

                                </div>
                            </div>';
                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.student_manegement_two.index');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $parent_categories = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();

            return view('admin.student_manegement_two.create', compact('parent_categories'));
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'payment_status' => 'required',


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
            $datauser = [
                'first_name' => $request->input('first_name'),
                'name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'user_type' => 3,
                'password' => $hashed_random_password,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('users')->insertGetId($datauser);
            $data = [
                'user_id' => $u_id,
                'payment_status' => $request->input('payment_status'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('students')->insert($data);

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
        $bill_details = new Student;
        $bill_details->user_id = $ur_id;
        // $bill_details->category = $request->category ?? '';
        // $bill_details->sub_category = $request->sub_category ?? '';
        // $bill_details->pincode = $request->pincode ?? '';
        // $bill_details->lat = $request->lat ?? '';
        // $bill_details->amount = $request->amount ?? '';
        // $bill_details->first_name = $request->first_name ?? '';
        // $bill_details->email = $request->email ?? '';
        // $bill_details->phone = $request->phone ?? '';
        $bill_details->r_payment_id =$request->payment_id;
        $bill_details->amount = $request->amount ?? '';
        $bill_details->payment_status = $request->payment_status ?? '';
        $bill_details->save();
        if (isset($bill_details)) {
            // $data = [
            //     'user_id' => $bill_details->id,
            //     'r_payment_id' => $request->payment_id,
            //     'amount' => $request->amount,
            // ];
            // $getId = DB::table('payments')->insertGetId($data);

            return view('admin.student_manegement_two.index');
        }
    }
    public function edit(Request $request)
    {
        $user_id = base64_decode($request->id);
        if ($request->isMethod('get')) {
            $user = DB::table('users')
            ->leftjoin('students', 'users.id', '=', 'students.user_id')
            ->select('users.*', 'students.payment_status')
            ->where('user_type',3)
            ->where('users.id', $user_id)->first();
            return view('admin.student_manegement_two.edit', compact('user'));
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
        DB::beginTransaction();
        try {
            $user  = DB::table('students')->where('id', $user_id)->first();

            $datauser = [
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id', $user_id)->update($datauser);

            // $data = [
            //     'payment_status' => $request->input('payment_status'),
            //     'status' => 1,
            //     'updated_at' => date('Y-m-d H:i:s')
            // ];

            // DB::table('students')->where('id', $user_id)->update($data);

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


//delete the assign teacher
    public function assign(Request $request)
    {
        $user_id = base64_decode($request->id);
        $assign = DB::table('credits')->where('student_id',$user_id)->first();
            if($assign){
                if ($request->isMethod('get')) {
                    $user = DB::table('users')
                    ->leftjoin('credits', 'users.id', '=', 'credits.student_id')
                    ->select('users.*', 'credits.credit','credits.class_id','credits.teacher_id','credits.sub_id')
                    ->where('users.id', $user_id)->first();
                    return view('admin.student_manegement_two.assingteacheredit', compact('user'));
                }
                $rules = [
                    'category' => 'required',
                    'tutor_name' => 'required',
                    'sub_category' => 'required',
                    'credit' => 'required'
                ];
                $validation = Validator::make($request->all(), $rules);

                if ($validation->fails()) {

                    return response()->json([
                        'success' => false,
                        'errors' => $validation->errors()
                    ]);
                }
            }else{
                if ($request->isMethod('get')) {
                    $user = DB::table('users')
                    ->leftjoin('students', 'users.id', '=', 'students.user_id')
                    ->select('users.*', 'students.payment_status')
                    ->where('user_type',3)
                    ->where('users.id', $user_id)->first();
                    return view('admin.student_manegement_two.assingteacher', compact('user'));
                }

            }
                    // dd($request->all());

                DB::beginTransaction();

                try{

                        $category = $request->category;
                        $student_id1 = [];

                        if (is_array($request->student_id1) && count($request->student_id1)>0) {
                            for ($i = 0; $i < count($category); $i++) {
                                $creditRecord1 = DB::table('credits')->where('id', $request->student_id1[$i])->where('student_id', $user_id)
                                ->where('teacher_id', $request->tutor_name[$i])->first();
                                if($creditRecord1)
                                {
                                    $student_id1[] = $request->student_id1[$i];
                                }
                            }
                        }
                        DB::table('credits')->where('student_id',$user_id)->whereNotIn('id', $student_id1)->delete();

                        // if (isset($request->student_id1[$i])) {
                            for ($i = 0; $i < count($category); $i++) {
                                $creditRecord = DB::table('credits')
                                    ->where('student_id', $user_id)
                                    ->where('teacher_id', $request->tutor_name[$i])
                                    ->first();

                                if (!$creditRecord) {
                                    $datauser = [
                                        'student_id' => $user_id,
                                        'class_id' => $request->category[$i],
                                        'sub_id' => $request->sub_category[$i],
                                        'teacher_id' => $request->tutor_name[$i],
                                        'credit' => $request->credit[$i],
                                        'created_at' => date('Y-m-d H:i:s')
                                    ];

                                    DB::table('credits')->insert($datauser);
                                } else {
                                    $datauser = [
                                        'class_id' => $request->category[$i],
                                        'sub_id' => $request->sub_category[$i],
                                        'teacher_id' => $request->tutor_name[$i],
                                        'credit' => $request->credit[$i],
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ];

                                    DB::table('credits')->where('id', $creditRecord->id)->update($datauser);
                                }
                            }

                            DB::commit();

                            return response()->json([
                                'success' => true
                            ]);
                    }
                        catch (\Exception $e) {
                            DB::rollback();

                            return $e;
                        }


            }
//delete the assign teacher
}
