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
class CommunityController extends Controller
{
    public function community(){
        return view('front.community');
    }

    public function index(Request $request){
        if($request->ajax())
        {
            $role = DB::table('communities')
            ->join('users','communities.community_type' , '=','users.id' )
            ->select('communities.*', 'users.name','users.email','users.phone','users.first_name','users.id as uid','users.status as us_id')
            ->where('users.user_type',2)
            ->where('communities.status','<>',2)
            ->orderBy('id','DESC')
            ->get();
// dd($role);
            // $role = DB::table('communities')
            // ->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })
            ->editColumn('community_type', function ($row) {
                    return '<span class="badge badge-soft-danger my-1 me-2">' . $row->community_type . '</span>';
            })
            ->editColumn('description', function ($row) {
                    return '<span class="badge badge-soft-danger my-1 me-2">' . $row->description . '</span>';
            })
            ->editColumn('image', function ($row) {
                $image = url('/uploads/communities/'.$row->image);
                return '<img class="mt-2" src="'.$image.'" width="100px" height="70px" alt="img">';
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

                $edit_url = url('/admin/community/edit',['id'=>base64_encode($row->id)]);

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

            $datatables = $datatables->rawColumns(['check', 'action','community_type','image','description'])->make(true);

            return $datatables;
        }
        return view('admin.community.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $tutors = DB::table('users')->where('user_type','<>',1)->where('status',1)->get();

           return view('admin.community.create',compact('tutors'));
            }

        $rules = [
            'title' => 'required',
            'community_type' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'

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

            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/communities/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            }
            // $slug = ltrim(rtrim(strtolower(str_replace(array(' ', '%', '°F', '---', '--'), '-', str_replace(array('&', '?'), '', str_replace('(', '', str_replace(')', '', str_replace(',', '', str_replace('®', '', trim($request->category_name)))))))), '-'), '-');

            // // check to see if any other slugs exist that are the same & count them

            // $slug_count = DB::table('categories')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // $slug = $slug_count ? "{$slug}-{$slug_count}" : $slug;


            // $string =  $request->c_code;
            // $s = $request->input('tutor_subject_teach');
            // $subject_teach_array = implode(",", $s);
            // dd($subject_teach_array);

            $data = [
                'title' => $request->input('title'),
                'community_type' => $request->input('community_type'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'status' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
            ];
            // dd($data);
            DB::table('communities')->insert($data);

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
        $community_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $tutors = DB::table('users')->where('user_type','<>',1)->where('status',1)->get();
            // $tutors = DB::table('tutors')->where('status',1)->get();
            // $users = DB::table('users')->where('user_type', 0)->get();

            // $options = [];

            // foreach ($tutors as $tutor) {
            //     $options[$tutor->id] = $tutor->name;
            // }

            // foreach ($users as $user) {
            //     $options[$user->id] = $user->name;
            // }

            $community  = DB::table('communities')->where('id',$community_id)->first();
            return view('admin.community.edit' ,compact('community','tutors'));
        }

        $rules = [
            'title' => 'required',
            'community_type' => 'required',
            'description' => 'required',
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
            $community  = DB::table('communities')->where('id',$community_id)->first();

            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/communities/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            } else {
                $final_image_name = $community->image;
            }
            // if ($request->file('icon')) {

            //     $image = $request->file('icon');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/communities/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // }

            $data = [
                'title' => $request->input('title'),
                'community_type' => $request->input('community_type'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('communities')->where('id',$community_id)->update($data);

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
        $comment = DB::table('community_comments')->where('id',$request->id)->first();

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
                'community_id' =>$request->input('community_id'),
                'user_id' => $userId ?? 0,
                'comment' => $request->input('comment'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('community_comments')->insert($data);

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
        $comment = DB::table('community_likes')->where('user_id',$auth)->where('community_id',$id)->first();
        if($request->active == 1){
            $data = [
                'user_id' =>  $auth ,
                'community_id' => $id,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }else{
            $data = [
                'user_id' =>  $auth ,
                'community_id' => $id,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        if($comment){
            DB::table('community_likes')->where('id',$comment->id)->update($data);
        }else{
            DB::table('community_likes')->insert($data);
        }

        return view('front.likes',compact('id'));
    }
}
