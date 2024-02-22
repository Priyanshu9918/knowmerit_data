<?php

namespace App\Http\Controllers\admin;

use App\Models\Faq;
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

class FaqController extends Controller
{
    public function faq(){
        return view('front.faq');
    }

    public function faqstudent(){
        return view('front.faq-student');
    }

    public function faqteacher(){
        return view('front.faq-teacher');
    }

    public function index(Request $request){

        if($request->ajax())
        {
            // $faqType = $request->input('f_type');
            // if($faqType == ''){
            //     $role = DB::table('faqs')->where('status', '<>', 2)->get();
            // }else{
            //     $role = DB::table('faqs')->where('f_type', $faqType)->get();
            // }
            $role = DB::table('faqs')->where('status', '<>', 2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('answer', function ($row) {
                    return '<span class="badge badge-soft-success my-1 me-2">' . $row->answer . '</span>';
            })
            ->editColumn('f_type', function ($row) {
                if($row->f_type == 0){
                    return '<span class="badge badge-soft-success my-1 me-2">Student</span>';
                }else{
                    return '<span class="badge badge-soft-success my-1 me-2">Teacher</span>';
                }
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

                $edit_url = url('/admin/faq/edit',['id'=>base64_encode($row->id)]);

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

            $datatables = $datatables->rawColumns(['check', 'action','answer','f_type'])->make(true);

            return $datatables;
        }

        return view('admin.faq.index');
    }

public function create(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('admin.faq.create');


        }

        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'f_type' => 'required',

            ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }

        // if ($request->input('parent_category') == NULL) {
        //     $rules = [
        //         'icon' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'
        //     ];

        //     $validation = Validator::make($request->all(), $rules);

        //     if ($validation->fails()) {

        //         return response()->json([
        //             'success' => false,
        //             'errors' => $validation->errors()
        //         ]);
        //     }
        // }

        DB::beginTransaction();
        try {

            // if ($request->file('image')) {

            //     $image = $request->file('image');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/faqs/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // }
            // $slug = ltrim(rtrim(strtolower(str_replace(array(' ', '%', '°F', '---', '--'), '-', str_replace(array('&', '?'), '', str_replace('(', '', str_replace(')', '', str_replace(',', '', str_replace('®', '', trim($request->category_name)))))))), '-'), '-');

            // // check to see if any other slugs exist that are the same & count them

            // $slug_count = DB::table('categories')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // $slug = $slug_count ? "{$slug}-{$slug_count}" : $slug;


            // $string =  $request->c_code;
            // $s = $request->input('tutor_subject_teach');
            // $subject_teach_array = implode(",", $s);
            // dd($subject_teach_array);

            $data = [
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'f_type' => $request->input('f_type'),
                'status' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
                ];
// dd($data);

            DB::table('faqs')->insert($data);

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
        $faq_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $faq  = DB::table('faqs')->where('id',$faq_id)->first();
            return view('admin.faq.edit' ,compact('faq'));
        }


        $rules = [
            'question' => 'required',
            'answer' => 'required',
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
            $faq  = DB::table('faqs')->where('id',$faq_id)->first();

            // if ($request->file('image')) {

            //     $image = $request->file('image');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/faqs/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // } else {
            //     $final_image_name = $tutor->image;
            // }
            // if ($request->file('icon')) {

            //     $image = $request->file('icon');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/faqs/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // }
            $data = [
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'f_type' => $request->input('f_type'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('faqs')->where('id',$faq_id)->update($data);

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
