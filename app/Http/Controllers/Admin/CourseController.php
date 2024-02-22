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
Use ZipArchive;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $id = base64_decode($request->id);
        return view('admin.tutor.courses',compact('id'));
    }
    public function indext(Request $request)
    {
        $id = base64_decode($request->id);
        return view('admin.tutor.coursest',compact('id'));
    }
    public function index1(Request $request)
    {
        $id = $request->id;
        return view('admin.tutor.add-lession',compact('id'));
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $course = DB::table('courses')->where('id',$id)->first();
        return view('admin.tutor.edit-chapter',compact('id','course'));
    }
    public function update(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',

            // 'image' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg'
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
            $crs = DB::table('courses')->where('id', $request->id)->first();

            if($request->file('image')){

                    $image = $request->file('image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/course/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);

            }else{
                $final_image_name = $crs->image;
            }

            $data = [
                'title' => $request->input('title'),
                'short_description' => $request->input('short_description'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name:NULL,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('courses')->where('id',$request->id)->update($data);

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
    public function create(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
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
        try{

            if($request->file('image')){

                    $image = $request->file('image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/course/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);

            }

                $data = [
                    'teacher_id' => Auth::user()->id,
                    'title' => $request->input('title'),
                    'short_description' => $request->input('short_description'),
                    'description' => $request->input('description'),
                    'image' => !empty($final_image_name) ? $final_image_name:NULL,
                    'is_user' => $request->input('is_user'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('courses')->insert($data);



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
    public function c_details(Request $request)
    {
        $id = $request->id;
        $t_courses = DB::table('courses')->where('id',$id)->first();
        return view('front.student.course-details',compact('t_courses'));
    }
    public function c_details1(Request $request)
    {
        $id = $request->id;
        $t_courses = DB::table('courses')->where('id',$id)->first();
        return view('admin.tutor.course-details',compact('t_courses'));
    }
    public function create1(Request $request)
    {
        $rules = [
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
                'student_id' => $request->input('student_id'),
                'teacher_id' => $request->input('teacher_id'),
                'course_id' => $request->input('course_id'),
                'title' => $request->input('title'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('lessions')->insert($data);

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
    public function createlecture(Request $request)
    {
        $rules = [
            'title' => 'required',
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

            $data = [
                'lession_id' => $request->input('lession'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('lectures')->insert($data);

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
    public function dellession(Request $request){
        DB::table('lessions')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function dellecture(Request $request){
        DB::table('lectures')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function delcourse(Request $request){
        DB::table('courses')->where('id',$request->id)->delete();
        // $lession = DB::table('lessions')->where('course_id',$request->id)->first();
        // DB::table('lectures')->where('lession_id',$lession->id)->first();
        // DB::table('lessions')->where('course_id',$request->id)->delete();

        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function editlession(Request $request)
    {
            $id = $request->active;
            $lession  = DB::table('lessions')->where('id',$id)->first();
            return view('admin.tutor.edit-lession',compact('lession'));
    }
    public function editlession1(Request $request)
    {
        $id = base64_decode($request->id);

        $rules = [
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
        try {
            $data = [
                'title' => $request->input('title'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('lessions')->where('id', $id)->update($data);

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
    public function editlecture(Request $request)
    {
            $id = $request->active;
            $lecture  = DB::table('lectures')->where('id',$id)->first();
            return view('admin.tutor.edit-lecture',compact('lecture'));
    }
    public function editlecture1(Request $request)
    {
        $id = base64_decode($request->id);
        $rules = [
            'title' => 'required',
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
        try {
            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('lectures')->where('id', $id)->update($data);

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
    public function c_video(Request $request)
    {
        $id = $request->id;
        $t_courses = DB::table('courses')->where('id',$id)->first();
        return view('admin.tutor.add-video',compact('t_courses','id'));
    }
    public function c_audio(Request $request)
    {
        $id = $request->id;
        $t_courses = DB::table('courses')->where('id',$id)->first();
        return view('admin.tutor.add-audio',compact('t_courses','id'));
    }
    public function createv(Request $request)
    {
        if($request->link){
            $rules = [
                'title' => 'nullable',
                'link' => 'nullable',
                'video' => 'nullable',
            ];
        }else{
            $rules = [
                'title' => 'nullable',
                'video' => 'required',
            ];
        }
        if($request->link && $request->video){
            return response()->json([
                'success1' => false,
                'errors1' => 'data'
            ]);
        }

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        if($request->file('video')){

                $image = $request->file('video');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_video_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_video/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_video_name);

        }
        DB::beginTransaction();
        try{
            $data = [
                'lession_id' => $request->input('course_id'),
                'video' =>!empty($final_video_name) ? $final_video_name:NULL,
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_videos')->insert($data);

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
    public function createa(Request $request)
    {
        $rules = [
            'title' => 'required',
            'audio' => 'required',

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        if($request->file('audio')){

                $image = $request->file('audio');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_audio_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_audio/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_audio_name);

        }
        DB::beginTransaction();
        try{
            $data = [
                'lession_id' => $request->input('course_id'),
                'title' => $request->input('title'),
                'audio' => $final_audio_name,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_audio')->insert($data);

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
    public function delvideo(Request $request){
        DB::table('course_videos')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function delaudio(Request $request){
        DB::table('course_audio')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function diframe(Request $request){
        $id = $request->id;
        $iframe = DB::table('course_iframes')->where('id',$id)->orderBy('created_at', 'desc')->first();
        DB::commit();
        return response()->json([
            'success' => true,
            'value' => $iframe
        ]);
    }
    public function preview(Request $request)
    {
        $id = $request->id;
        $lession = DB::table('lectures')->where('id',$id)->first();
        $chapture = DB::table('lessions')->where('id',$lession->lession_id)->first();
        $course = DB::table('courses')->where('id',$chapture->course_id)->first();
        return view('admin.tutor.preview',compact('lession','id','chapture','course'));
    }
    public function dvideo(Request $request)
    {
        $id = $request->id;
        $c_video = DB::table('course_videos')->where('id',$id)->orderBy('created_at', 'desc')->first();
        // dd($c_video);
        if($c_video->video != null){
            return response()->json([
                'success' => true,
                'value' => $c_video
            ]);
        }else{
            return response()->json([
                'success1' => true,
                'value' => $c_video
            ]);
        }

    }
    public function daudio(Request $request)
    {
        $id = $request->id;
        $c_audio = DB::table('course_audio')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return response()->json([
            'success' => true,
            'value' => $c_audio
        ]);
    }
    public function iframeCreate(Request $request)
    {
        $rules = [
            'title' => 'required',
            'url' => 'required',
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
            // $d12 = DB::table('course_iframes')->where('lession_id',$request->id)->first();
            // if(!isset($d12)){
                $data = [
                    'lession_id' => $request->input('lession'),
                    'url' => $request->input('url'),
                    'title' => $request->input('title'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                DB::table('course_iframes')->insert($data);
            // }else{
            //     $data = [
            //         'lession_id' => $request->input('lession'),
            //         'url' => $request->input('url'),
            //         'title' => $request->input('title'),
            //         'created_at' => date('Y-m-d H:i:s')
            //     ];

            //     DB::table('course_iframes')->where('lession_id',$request->id)->update($data);
            // }


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
    public function iframePresentaion(Request $request)
    {
        $rules = [
            'title' => 'required',
            'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        if($request->file('file')){

                $image = $request->file('file');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_file_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_file/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_file_name);
        }
        DB::beginTransaction();
        try{
            $data = [
                'lession_id' => $request->input('lession_id'),
                'title' => $request->input('title'),
                'file' => $final_file_name,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_presentations')->insert($data);

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
    public function dpresentation(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_presentations')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('admin.tutor.my-docs',compact('presentation'));
    }
    public function iframeAssign(Request $request)
    {
        $rules = [
            'title' => 'required',
            'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        if($request->file('file')){

                $image = $request->file('file');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_file_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_assign/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_file_name);
        }
        DB::beginTransaction();
        try{
            $data = [
                'lession_id' => $request->input('lession_id'),
                'title' => $request->input('title'),
                'file' => $final_file_name,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_assignments')->insert($data);

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
    public function dAssign(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_assignments')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('admin.tutor.my-docs1',compact('presentation'));
    }

    public function ScromCreate(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' => 'required',
            'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $Zip = New ZipArchive();

        $Status = $Zip->Open($request->file("file")->getRealPath());
        if($Status !== true) {
            throw new \Exception($Status);
        }
        else
        {
            $StorageDestinationPath= public_path('/uploads/Scrom/'.$request->title.'/');

            if (!\File::Exists( $StorageDestinationPath)) {
                \File::MakeDirectory($StorageDestinationPath, 0755, True);
            }
            $Zip->ExtractTo($StorageDestinationPath);
            $Zip->Close();
        }

        DB::beginTransaction();
        try{
            $data = [
                'lession_id' => $request->input('lession_id'),
                'title' => $request->input('title'),
                'file' => $request->input('title'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_scroms')->insert($data);

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
    public function dScrom(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_scroms')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('admin.tutor.my-docs2',compact('presentation'));
    }
    public function QuizCreate(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' => 'required',
            'url' => 'required',
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
                'lession_id' => $request->input('lession_id'),
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_quizzes')->insert($data);

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
    public function dQuiz(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_quizzes')->where('id',$id)->orderBy('created_at', 'desc')->first();
        DB::commit();
        return response()->json([
            'success' => true,
            'value' => $presentation
        ]);
    }
    public function webCreate(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title1' => 'required',
            'content' => 'required',
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
                'lession_id' => $request->input('lession_id'),
                'title' => $request->input('title1'),
                'content' => $request->input('content'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_web_contents')->insert($data);

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
    public function dWeb(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_web_contents')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('admin.tutor.my-docs3',compact('presentation'));
    }
    public function editdata(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $iframe  = DB::table('course_iframes')->where('id',$id)->first();
            return view('front.teacher.edit-iframe',compact('iframe'));
    }
    public function updateiframe(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            'url' => 'required',

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
                'url' => $request->input('url'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_iframes')->where('id', $id)->update($data);

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
    public function editpresentation(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $presentation  = DB::table('course_presentations')->where('id',$id)->first();
            return view('front.teacher.edit-presentation',compact('presentation'));
    }
    public function updatepresentation(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            // 'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $presentation = DB::table('course_presentations')->where('id',$id)->first();
        if($request->file('file')){
                $image = $request->file('file');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_file_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_file/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_file_name);
        }else{
            $final_file_name = $presentation->file;
        }
        DB::beginTransaction();
        try{
            $data = [
                'title' => $request->input('title'),
                'file' => $final_file_name,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_presentations')->where('id',$id)->update($data);

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
    public function editassign(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $assign  = DB::table('course_assignments')->where('id',$id)->first();
            return view('front.teacher.edit-assign',compact('assign'));
    }
    public function updateassign(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            // 'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $presentation = DB::table('course_assignments')->where('id',$id)->first();
        if($request->file('file')){
                $image = $request->file('file');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_file_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_assign/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_file_name);
        }else{
            $final_file_name = $presentation->file;
        }
        DB::beginTransaction();
        try{
            $data = [
                'title' => $request->input('title'),
                'file' => $final_file_name,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_assignments')->where('id',$id)->update($data);

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
    public function editquiz(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $quiz  = DB::table('course_quizzes')->where('id',$id)->first();
            return view('front.teacher.edit-quiz',compact('quiz'));
    }
    public function updatequiz(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            'url' => 'required',
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
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_quizzes')->where('id',$id)->update($data);

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
    public function editweb(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $web  = DB::table('course_web_contents')->where('id',$id)->first();
            return view('front.teacher.edit-web',compact('web'));
    }
    public function updateweb(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title1' => 'required',
            'content' => 'required',
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
                'title' => $request->input('title1'),
                'content' => $request->input('content'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_web_contents')->where('id',$id)->update($data);

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
    public function editaudio(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $audio  = DB::table('course_audio')->where('id',$id)->first();
            return view('front.teacher.edit-audio',compact('audio'));
    }
    public function updateaudio(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            // 'audio' => 'required',

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        $audio = DB::table('course_audio')->where('id',$id)->first();
        if($request->file('audio')){

                $image = $request->file('audio');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_audio_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_audio/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_audio_name);

        }else{
            $final_audio_name = $audio->audio;
        }
        DB::beginTransaction();
        try{
            $data = [
                'title' => $request->input('title'),
                'audio' => $final_audio_name,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            DB::table('course_audio')->where('id',$id)->update($data);

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
    public function editvideo(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $video  = DB::table('course_videos')->where('id',$id)->first();
            if(isset($video) && $video->video != null){
                return view('front.teacher.edit-video',compact('video'));
            }else{
                return view('front.teacher.edit-video1',compact('video'));
            }
    }
    public function updatevideo(Request $request)
    {
        $id = $request->id;

        if($request->link){
            $rules = [
                'title' => 'nullable',
                'link' => 'nullable',
                'video' => 'nullable',
            ];
        }else{
            $rules = [
                'title' => 'nullable',
                // 'video' => 'required',
            ];
        }
        if($request->link && $request->video){
            return response()->json([
                'success1' => false,
                'errors1' => 'data'
            ]);
        }

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        $video = DB::table('course_videos')->where('id',$id)->first();
        if($request->file('video')){
                $image = $request->file('video');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_video_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/c_video/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_video_name);

        }else{
            $final_video_name = $video->video;
        }

        DB::beginTransaction();
        try{
            $data = [
                'video' =>!empty($final_video_name) ? $final_video_name:NULL,
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_videos')->where('id',$id)->update($data);

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

    public function editscrom(Request $request)
    {
            $id = $request->id;
            $type = $request->type;
            $scrom  = DB::table('course_scroms')->where('id',$id)->first();
            return view('front.teacher.edit-scrom',compact('scrom'));
    }

    public function updatescrom(Request $request)
    {
        $id = $request->id;
        $rules = [
            'title' => 'required',
            // 'file' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        $scrom1 = DB::table('course_scroms')->where('id',$id)->first();
        if($request->file("file") != null){
            $file_title =  $request->input('title');
            $Zip = New ZipArchive();

            $Status = $Zip->Open($request->file("file")->getRealPath());
            if($Status !== true) {
                throw new \Exception($Status);
            }
            else
            {
                $StorageDestinationPath= public_path('/uploads/Scrom/'.$request->title.'/');
    
                if (!\File::Exists( $StorageDestinationPath)) {
                    \File::MakeDirectory($StorageDestinationPath, 0755, True);
                }
                $Zip->ExtractTo($StorageDestinationPath);
                $Zip->Close();
            }
        }else{
            $file_title = $scrom1->title;
        }

        DB::beginTransaction();
        try{
            $data = [
                'title' => $request->input('title'),
                'file' => $file_title,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('course_scroms')->where('id',$id)->update($data);

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
    public function deldata(Request $request){
        // dd($request->all());
        if($request->type == 'presentation'){
            DB::table('course_presentations')->where('id',$request->id)->delete();
        }
        if($request->type == 'video'){
            DB::table('course_videos')->where('id',$request->id)->delete();
        }
        if($request->type == 'audio'){
            DB::table('course_audio')->where('id',$request->id)->delete();
        }
        if($request->type == 'iframe'){
            DB::table('course_iframes')->where('id',$request->id)->delete();
        }
        if($request->type == 'scrom'){
            DB::table('course_scroms')->where('id',$request->id)->delete();
        }
        if($request->type == 'quiz'){
            DB::table('course_quizzes')->where('id',$request->id)->delete();
        }
        if($request->type == 'web'){
            DB::table('course_web_contents')->where('id',$request->id)->delete();
        }
        if($request->type == 'assign'){
            DB::table('course_assignments')->where('id',$request->id)->delete();
        }


        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }

    public function index3(Request $request)
    {
        $id = base64_decode($request->id);
        return view('admin.tutor.assign-teacher',compact('id'));
    }

    public function assignteacher(Request $request)
    {
        $rules = [
            'course' => 'required',
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

            for($i = 0; $i < count($request->input('course')); $i++) {
                $data1 = [
                    'course_id' => $request->input('course')[$i],
                    'teacher_id' => $request->input('teacher_id'),
                    'created_at' => now()
                ];
                DB::table('assign_teachers')->insert($data1);
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
