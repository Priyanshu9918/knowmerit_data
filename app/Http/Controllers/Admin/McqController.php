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
use App\Models\ManagePage;
class McqController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $role = DB::table('mcq_types')
            ->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })
            ->editColumn('category', function ($row) {
                if(isset( $row->category ))
                {
                    $cate = DB::table('categories')->where('id',$row->category)->first();
                    return $cate->name;
                }
            })
            ->editColumn('sub_category', function ($row) {
                if(isset( $row->sub_category ))
                {
                    $sub_cate = DB::table('categories')->where('id',$row->sub_category)->first();
                    return $sub_cate->name;
                }
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

                $edit_url = url('/admin/mcq/edit',['id'=>base64_encode($row->id)]);

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

            $datatables = $datatables->rawColumns(['check','action','image','description'])->make(true);

            return $datatables;
        }
        return view('admin.mcq.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $parent_cat = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
            return view('admin.mcq.create',compact('parent_cat'));
        }
        // dd($request->all());
        $rules = [
            'category' => 'required',
            'sub_category' => 'required',
            'title' => 'required',
            // 'question' => 'required',
            // 'ans1' => 'required',
            // 'ans2' => 'required',
            // 'ans3' => 'required',
            // 'ans4' => 'required',
            // 'answer' => 'required',
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
            $data = [
                'category' => $request->input('category'),
                'sub_category' => $request->input('sub_category'),
                'mcq_title' => $request->input('title'),
                'status' => 1,
            ];
            $mcq_type_id = DB::table('mcq_types')->insertGetId($data);
            $question = $request->question;
            for($i=0; $i < count($question); $i++){
                $data1 = [
                    'mcq_type_id' => $mcq_type_id,
                    'Questions' => $question[$i],
                    'ans1' => $request->ans1[$i],
                    'ans2' => $request->ans2[$i],
                    'ans3' => $request->ans3[$i],
                    'ans4' => $request->ans4[$i],
                    'answer' => $request->answer[$i],
                ];
                DB::table('mcqs')->insertGetId($data1);
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


    public function edit(Request $request)
    {
        $mcq_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $parent_cat = DB::table('categories')->where('parent', 0)->where('status', '<>', 2)->get();
            $parent_cat1 = DB::table('categories')->where('parent','<>', 0)->where('status', '<>', 2)->get();
            $mcq  = DB::table('mcq_types')->where('id',$mcq_id)->first();
            return view('admin.mcq.edit' ,compact('mcq','parent_cat','parent_cat1'));
        }

        $rules = [
            'category' => 'required',
            'sub_category' => 'required',
            'title' => 'required',
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
                'category' => $request->input('category'),
                'sub_category' => $request->input('sub_category'),
                'mcq_title' => $request->input('title'),
                'status' => 1,
            ];
            $mcq_type_id = DB::table('mcq_types')->where('id',$mcq_id)->update($data);
            $question = $request->question;
            for($i=0; $i < count($question); $i++){
                if($request->mcq_id1[$i] == ''){
                    $data1 = [
                        'mcq_type_id' => $mcq_id,
                        'Questions' => $question[$i],
                        'ans1' => $request->ans1[$i],
                        'ans2' => $request->ans2[$i],
                        'ans3' => $request->ans3[$i],
                        'ans4' => $request->ans4[$i],
                        'answer' => $request->answer[$i],
                    ];
                    DB::table('mcqs')->insertGetId($data1);
                }else{
                    $data1 = [
                        // 'mcq_type_id' => $mcq_type_id,
                        'Questions' => $question[$i],
                        'ans1' => $request->ans1[$i],
                        'ans2' => $request->ans2[$i],
                        'ans3' => $request->ans3[$i],
                        'ans4' => $request->ans4[$i],
                        'answer' => $request->answer[$i],
                    ];
                    DB::table('mcqs')->where('id',$request->mcq_id1[$i])->update($data1);
                }
            }
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
