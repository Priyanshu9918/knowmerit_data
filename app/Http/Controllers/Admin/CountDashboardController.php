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
class CountDashboardController extends Controller
{

    public function index(Request $request){
        if($request->ajax())
        {

            $role = DB::table('count_dashboards')
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

                $edit_url = url('/admin/count/edit',['id'=>base64_encode($row->id)]);

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

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }
        return view('admin.counts.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
               return view('admin.counts.create');
            }

        $rules = [
            'title' => 'required',
            'cetified_courses' => 'required',
            'expert_tutors' => 'required',
            'online_students' => 'required',
            'online_courses' => 'required',
            'cetified_courses_count' => 'required',
            'expert_tutors_count' => 'required',
            'online_students_count' => 'required',
            'online_courses_count' => 'required'


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
                'title' => $request->input('title'),
                'cetified_courses_count' => $request->input('cetified_courses_count'),
                'expert_tutors_count' => $request->input('expert_tutors_count'),
                'online_students_count' => $request->input('online_students_count'),
                'online_courses_count' => $request->input('online_courses_count'),
                'cetified_courses' => $request->input('cetified_courses'),
                'expert_tutors' => $request->input('expert_tutors'),
                'online_students' => $request->input('online_students'),
                'online_courses' => $request->input('online_courses'),
                'status' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
            ];
            // dd($data);
            DB::table('count_dashboards')->insert($data);

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
        $count_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $count  = DB::table('count_dashboards')->where('id',$count_id)->first();
            return view('admin.counts.edit' ,compact('count'));
        }

        $rules = [
            'title' => 'required',
            'cetified_courses' => 'required',
            'expert_tutors' => 'required',
            'online_students' => 'required',
            'online_courses' => 'required',
            'cetified_courses_count' => 'required',
            'expert_tutors_count' => 'required',
            'online_students_count' => 'required',
            'online_courses_count' => 'required'
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
            $count  = DB::table('count_dashboards')->where('id',$count_id)->first();


            $data = [
                'title' => $request->input('title'),
                'cetified_courses_count' => $request->input('cetified_courses_count'),
                'expert_tutors_count' => $request->input('expert_tutors_count'),
                'online_students_count' => $request->input('online_students_count'),
                'online_courses_count' => $request->input('online_courses_count'),
                'cetified_courses' => $request->input('cetified_courses'),
                'expert_tutors' => $request->input('expert_tutors'),
                'online_students' => $request->input('online_students'),
                'online_courses' => $request->input('online_courses'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('count_dashboards')->where('id',$count_id)->update($data);

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
    public function index1(Request $request)
    {
        $comment = DB::table('count_comments')->where('id',$request->id)->first();

        return response()->json(array('status'=>true,'fdata'=>$comment));
    }

    public function create1(Request $request)
    {
        $userId = Auth::user()->id;
        $rules = [
            'comment' => 'required',
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
                'parent' => $request->input('comment_id')!=NULL ? $request->input('comment_id') : 0,
                'count_id' =>$request->input('count_id'),
                'user_id' => $userId ?? 0,
                'comment' => $request->input('comment'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('count_comments')->insert($data);

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
    public function likes(Request $request)
    {
        $id =  $request->id;
        $auth = Auth::user()->id;
        $comment = DB::table('count_likes')->where('user_id',$auth)->where('count_id',$id)->first();
        if($request->active == 1){
            $data = [
                'user_id' =>  $auth ,
                'count_id' => $id,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }else{
            $data = [
                'user_id' =>  $auth ,
                'count_id' => $id,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        if($comment){
            DB::table('count_likes')->where('id',$comment->id)->update($data);
        }else{
            DB::table('count_likes')->insert($data);
        }

        return view('front.likes',compact('id'));
    }
}
