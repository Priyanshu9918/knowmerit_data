<?php

namespace App\Http\Controllers\Admin;

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
class AboutUsController extends Controller
{
    public function about(){
        return view('front.about');
    }
    public function index(Request $request){
        if($request->ajax())
        {
            $role = DB::table('about_us')
            ->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
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

                $edit_url = url('/admin/about-us/edit',['id'=>base64_encode($row->id)]);

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

            $datatables = $datatables->rawColumns(['check', 'action','image'])->make(true);

            return $datatables;
        }
        return view('admin.about.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $about = DB::table('about_us')->where('status',1)->get();
           return view('admin.about.create',compact('about'));
            }

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',
            'm_title' => 'required',
            'm_description' => 'required',
            'r_description' => 'required',
            'm_rating'=> 'required',
            'm_grade'=> 'required',
            'm_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',
            'b_title' => 'required',
            'b_description' => 'required',
            'b_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'

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

            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            }

            if ($request->file('b_image')) {

                $b_image = $request->file('b_image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_b_image_name = $date . $random_no . '.' . $b_image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $b_image->move($destination_path, $final_b_image_name);
            } else {
                $final_b_image_name = $about->b_image;
            }
            if ($request->file('m_image')) {

                $m_image = $request->file('m_image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_m_image_name = $date . $random_no . '.' . $m_image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $m_image->move($destination_path, $final_m_image_name);
            } else {
                $final_m_image_name = $about->m_image;
            }


            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'm_title' => $request->input('m_title'),
                'm_description' => $request->input('m_description'),
                'r_description' => $request->input('r_description'),
                'm_rating' => $request->input('m_rating'),
                'm_grade' => $request->input('m_grade'),
                'm_image' => !empty($final_m_image_name) ? $final_m_image_name : NULL,
                'b_title' => $request->input('b_title'),
                'b_description' => $request->input('b_description'),
                'b_image' => !empty($final_b_image_name) ? $final_b_image_name : NULL,
                'status' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
            ];
            // dd($data);
            DB::table('about_us')->insert($data);

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
        $about_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            // $tutors = DB::table('tutors')->where('status',1)->get();
            // $users = DB::table('users')->where('user_type', 0)->get();

            // $options = [];

            // foreach ($tutors as $tutor) {
            //     $options[$tutor->id] = $tutor->name;
            // }

            // foreach ($users as $user) {
            //     $options[$user->id] = $user->name;
            // }

            $about  = DB::table('about_us')->where('id',$about_id)->first();
            return view('admin.about.edit' ,compact('about'));
        }

        $rules = [
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',
            'm_title' => 'required',
            'm_description' => 'required',
            'r_description' => 'required',
            'm_rating'=> 'required',
            'm_grade'=> 'required',
            // 'm_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',
            'b_title' => 'required',
            'b_description' => 'required',
            // 'b_image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'

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
            $about  = DB::table('about_us')->where('id',$about_id)->first();

            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            } else {
                $final_image_name = $about->image;
            }

            if ($request->file('b_image')) {

                $b_image = $request->file('b_image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_b_image_name = $date . $random_no . '.' . $b_image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $b_image->move($destination_path, $final_b_image_name);
            } else {
                $final_b_image_name = $about->b_image;
            }
            if ($request->file('m_image')) {

                $m_image = $request->file('m_image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_m_image_name = $date . $random_no . '.' . $m_image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/about/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $m_image->move($destination_path, $final_m_image_name);
            } else {
                $final_m_image_name = $about->m_image;
            }


            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'm_title' => $request->input('m_title'),
                'm_description' => $request->input('m_description'),
                'r_description' => $request->input('r_description'),
                'm_rating' => $request->input('m_rating'),
                'm_grade' => $request->input('m_grade'),
                'm_image' => !empty($final_m_image_name) ? $final_m_image_name : NULL,
                'b_title' => $request->input('b_title'),
                'b_description' => $request->input('b_description'),
                'b_image' => !empty($final_b_image_name) ? $final_b_image_name : NULL,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('about_us')->where('id',$about_id)->update($data);

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
