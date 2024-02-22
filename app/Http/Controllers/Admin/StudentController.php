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

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $games = DB::table('book_a_classes')->where('status', '<>', 2)->orderBy('id','DESC')->get();
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

                    $edit_url = url('/admin/student_manegement/edit', ['id' => base64_encode($row->id)]);

                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                data-bs-toggle="tooltip" data-placement="top" title=""
                data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                <i class="fas fa-trash text-danger"></i>
            </a>';

                    $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                ' . $action_1 . '
                                    ' . $action_2 . '
                                    ' . $action_3 . '
                                </div>
                            </div>';
                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.student_manegement.index');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $parent_categories = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();

            return view('admin.student_manegement.create', compact('parent_categories'));
        }

        $rules = [
            'category' => 'required',
            'sub_category' => 'required',
            'avatar' => 'required',
            'pincode' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'classes_choice' => 'required',
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
                'avatar' => !empty($final_image_name) ? $final_image_name : NULL,
                'phone' => $request->input('phone'),
                'user_type' => 3,
                'password' => $hashed_random_password,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('users')->insertGetId($datauser);
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

            DB::table('book_a_classes')->insert($data);

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
        $bill_details->save();
        if (isset($bill_details)) {
            $data = [
                'user_id' => $bill_details->id,
                'r_payment_id' => $request->payment_id,
                'amount' => $request->amount,
            ];
            $getId = DB::table('payments')->insertGetId($data);

            return view('admin.student_manegement.index');
        }
    }
    public function edit(Request $request)
    {
        $user_id = base64_decode($request->id);
        if ($request->isMethod('get')) {
            $user  = DB::table('book_a_classes')->where('id', $user_id)->first();
            $userdata  = DB::table('users')->where('id', $user->user_id)->first();
            $parent_categories = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
            return view('admin.student_manegement.edit', compact('user', 'parent_categories'));
        }

        $rules = [
            'category' => 'required',
            'pincode' => 'required',
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
            $user  = DB::table('book_a_classes')->where('id', $user_id)->first();

            $datauser = [
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id', $user->user_id)->update($datauser);

            $data = [
                'category' => $request->input('category'),
                'sub_category' => $request->input('sub_category'),
                'pincode' => $request->input('pincode'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'classes_choice' => $request->input('classes_choice'),
                'payment_status' => $request->input('payment_status'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('book_a_classes')->where('id', $user_id)->update($data);

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
}
