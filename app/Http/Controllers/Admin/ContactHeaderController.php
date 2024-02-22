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


class ContactHeaderController extends Controller
{
        public function index(Request $request){
            if($request->ajax())
            {
                $role = DB::table('contact_headers')
                ->where('status','<>',2)->orderBy('id','DESC')->get();
                $datatables = Datatables::of($role)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y',strtotime($row->created_at));
                })
                ->editColumn('description', function ($row) {
                    return '<span class="badge badge-soft-danger my-1 me-2">' . $row->description . '</span>';
                })
                ->editColumn('one_image', function ($row) {
                    $one_image = url('/uploads/contact_headers/'.$row->one_image);
                    return '<img class="mt-2" src="'.$one_image.'" width="100px" height="70px" alt="img">';
                })
                ->addColumn('action', function($row) {
                    $action_1 = '';
                    if($row->status==0)
                    {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                        </a>';
                        //dd($action_1);
                    }
                    else
                    {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                        </a>';
                    }

                    $edit_url = url('/admin/contact_headers/edit',['id'=>base64_encode($row->id)]);

                    $action_2 = '<a href="'.$edit_url.'" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                    data-bs-toggle="tooltip" data-placement="top" title=""
                    data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                    <i class="fas fa-trash text-danger"></i>
                </a>';

                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                    '.$action_1.'
                                        '.$action_2.'
                                        '.$action_3.'
                                    </div>
                                </div>';
                    return $action;
                });

                $datatables = $datatables->rawColumns(['check', 'action','one_image','description'])->make(true);

                return $datatables;
            }
            return view('admin.contact_headers.index');
        }

        public function create(Request $request)
        {
            if ($request->isMethod('get')) {
                $contact_headers = DB::table('contact_headers')->where('status',1)->get();
               return view('admin.contact_headers.create',compact('contact_headers'));
                }

            $rules = [
                'description' => 'required',
                'one_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'
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

                if ($request->file('one_image')) {

                    $one_image = $request->file('one_image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_one_image_name = $date . $random_no . '.' . $one_image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/contact_headers/');
                    if (!File::exists($destination_path)) {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $one_image->move($destination_path, $final_one_image_name);
                }

                $data = [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'one_image' => !empty($final_one_image_name) ? $final_one_image_name : NULL,
                    'status' => 1,
                    'created_at' =>date('Y-m-d H:i:s'),
                ];
                // dd($data);
                DB::table('contact_headers')->insert($data);

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
        public function edit(Request $request)
        {
            $contact_headers_id = base64_decode($request->id);

            if($request->isMethod('get'))
            {

                $contact_headers  = DB::table('contact_headers')->where('id',$contact_headers_id)->first();
                return view('admin.contact_headers.edit' ,compact('contact_headers'));
            }

            $rules = [
                'description' => 'required',
                // 'one_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'

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
                $contact_headers  = DB::table('contact_headers')->where('id',$contact_headers_id)->first();
                if ($request->file('one_image')) {

                    $one_image = $request->file('one_image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_one_image_name = $date . $random_no . '.' . $one_image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/contact_headers/');
                    if (!File::exists($destination_path)) {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $one_image->move($destination_path, $final_one_image_name);
                } else {
                    $final_one_image_name = $contact_headers->one_image;
                }


                $data = [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'one_image' => !empty($final_one_image_name) ? $final_one_image_name : NULL,
                    'status' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                DB::table('contact_headers')->where('id',$contact_headers_id)->update($data);

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
}
