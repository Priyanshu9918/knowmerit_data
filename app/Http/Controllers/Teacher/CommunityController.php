<?php

namespace App\Http\Controllers\Teacher;

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
    public function create(Request $request)
    {

        $rules = [
            'title' => 'required',
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

            $data = [
                'title' => $request->input('title'),
                'community_type' => Auth::user()->id,
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
