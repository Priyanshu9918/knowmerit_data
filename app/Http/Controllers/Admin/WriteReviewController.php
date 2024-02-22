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
class WriteReviewController extends Controller
{
    public function writeReview(){
        return view('front.write-a-review');
    }


    public function index(Request $request){
        if($request->ajax())
        {

            $role = DB::table('write_reviews')
            ->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })

            ->addColumn('action', function($row) {
                // $action_1 = '';
                // if($row->status==0)
                // {
                //     $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                //                         data-bs-toggle="tooltip" data-placement="top" title=""
                //                         data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                //                         <span class="icon">
                //                         <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                //                     </a>
                //                     <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                //                         data-bs-toggle="tooltip" data-placement="top" title=""
                //                         data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                //                         <span class="icon">
                //                         <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                //                     </a>';
                //     //dd($action_1);
                // }
                // else
                // {
                //     $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                //                         data-bs-toggle="tooltip" data-placement="top" title=""
                //                         data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                //                         <span class="icon">
                //                         <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                //                     </a>
                //                     <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                //                         data-bs-toggle="tooltip" data-placement="top" title=""
                //                         data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                //                         <span class="icon">
                //                         <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                //                     </a>';
                // }

                $view_url = url('/admin/write-a-review/view',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$view_url.'" class="btn btn-sm btn-clean btn-icon" title="view"><i class="fas fa-eye text-info"></i></a>';

            //     $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
            //     data-bs-toggle="tooltip" data-placement="top" title=""
            //     data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
            //     <i class="fas fa-trash text-danger"></i>
            // </a>';

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">

                                    '.$action_2.'

                                </div>
                            </div>';
                return $action;
            });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }
        return view('admin.write-a-review.index');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('front.write-a-review');
        }

        $rules = [
            'tutor_type' => 'required',
            'tutor_name' => 'required',
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
        try {


            $data = [
                'tutor_type' => $request->input('tutor_type'),
                'tutor_name' => $request->input('tutor_name'),
                'student_id' => $request->input('student_id'),
                'comment' => $request->input('comment'),
                'status' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
                ];


            DB::table('write_reviews')->insert($data);

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

    public function view(Request $request)
    {
        $review_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            // $tutors = DB::table('users')->where('user_type','<>',1)->where('status',1)->get();
            // $tutors = DB::table('tutors')->where('status',1)->get();
            // $users = DB::table('users')->where('user_type', 0)->get();

            // $options = [];

            // foreach ($tutors as $tutor) {
            //     $options[$tutor->id] = $tutor->name;
            // }

            // foreach ($users as $user) {
            //     $options[$user->id] = $user->name;
            // }

            $review  = DB::table('write_reviews')->where('id',$review_id)->first();
            return view('admin.write-a-review.view' ,compact('review'));
        }

    }
}
