<?php

namespace App\Http\Controllers\student;

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

class CourseController extends Controller
{
    public function preview(Request $request)
    {
        $id = $request->id;
        $lession = DB::table('lectures')->where('id',$id)->first();
        $chapture = DB::table('lessions')->where('id',$lession->lession_id)->first();
        $course = DB::table('courses')->where('id',$chapture->course_id)->first();
        return view('front.student.preview',compact('lession','id','chapture','course'));
    }
    public function dvideo(Request $request)
    {
        $id = $request->id;
        $c_video = DB::table('course_videos')->where('id',$id)->orderBy('created_at', 'desc')->first();
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
    public function diframe(Request $request){
        $id = $request->id;
        $iframe = DB::table('course_iframes')->where('id',$id)->orderBy('created_at', 'desc')->first();
        DB::commit();
        return response()->json([
            'success' => true,
            'value' => $iframe
        ]);
    }
    public function dpresentation(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_presentations')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('front.student.my-docs',compact('presentation'));
    }
    public function dAssign(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_assignments')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('front.teacher.my-docs1',compact('presentation'));
    }
    public function dComplete(Request $request){
        $id = $request->id;
        $type = $request->type;
        if($type == 'video'){
            $c_video = DB::table('course_videos')->where('id',$id)->orderBy('created_at', 'desc')->first();
            DB::table('course_videos')->where('id',$c_video->id)->update(['is_completed'=>1]);
        }
        if($type == 'audio'){
            $c_audio = DB::table('course_audio')->where('id',$id)->orderBy('created_at', 'desc')->first();
            DB::table('course_audio')->where('id',$c_audio->id)->update(['is_completed'=>1]);
        }
        if($type == 'iframe'){
            $iframe = DB::table('course_iframes')->where('id',$id)->orderBy('created_at', 'desc')->first();
            DB::table('course_iframes')->where('id',$iframe->id)->update(['is_completed'=>1]);
        }
        if($type == 'presentation'){
            DB::table('course_presentations')->where('id',$id)->update(['is_completed'=>1]);
        }
        if($type == 'assign'){
            DB::table('course_assignments')->where('id',$id)->update(['is_completed'=>1]);
        }
        if($type == 'scrom'){
            DB::table('course_scroms')->where('id',$id)->update(['is_completed'=>1]);
        }
        if($type == 'quiz'){
            DB::table('course_quizzes')->where('id',$id)->update(['is_completed'=>1]);
        }
        if($type == 'web'){
            DB::table('course_web_contents')->where('id',$id)->update(['is_completed'=>1]);
        }
        DB::commit();
        return response()->json([
            'success' => true,
            'type' => $type
        ]);
    }
    public function dScrom(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_scroms')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('front.student.my-docs2',compact('presentation'));
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
    public function dWeb(Request $request){
        $id = $request->id;
        $presentation = DB::table('course_web_contents')->where('id',$id)->orderBy('created_at', 'desc')->first();
        return view('front.student.my-docs3',compact('presentation'));
    }
    public function compt(Request $request){
        $id = $request->id;
        $type = $request->type;
        $lession = $request->l_id;
        if($type == 'video'){
            $video11 = DB::table('course_videos')->where('lession_id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('video11','lession'));
        }
        if($type == 'audio'){
            $audio11 = DB::table('course_audio')->where('lession_id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('audio11','lession'));
        }
        if($type == 'iframe'){
            $iframe11 = DB::table('course_iframes')->where('lession_id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('iframe11','lession'));
        }
        if($type == 'presentaion'){
            $presentaion = DB::table('course_presentations')->where('id',$id)->orderBy('created_at',
            'desc')->first();
            return view('front.student.my-doc-status',compact('presentaion','lession'));
        }
        if($type == 'assign'){
            $Assign = DB::table('course_assignments')->where('id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('Assign','lession'));
        }
        if($type == 'scrom'){
            $Scrom = DB::table('course_scroms')->where('id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status1',compact('Scrom','lession'));
        }
        if($type == 'quiz'){
            $Quiz = DB::table('course_quizzes')->where('id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('Quiz','lession'));
        }
        if($type == 'web'){
            $Web = DB::table('course_web_contents')->where('id',$id)->orderBy('created_at', 'desc')->first();
            return view('front.student.my-doc-status',compact('Web','lession'));
        }
    }
    public function preview1(Request $request)
    {
        $id = $request->id;
        $course = DB::table('courses')->where('id',$id)->first();
        $lession = DB::table('course_games')->where('course_id',$id)->first();
        return view('front.student.preview-game',compact('lession','course'));
    }
    public function diframe1(Request $request){
        $id = $request->id;
        $iframe = DB::table('course_games')->where('id',$id)->orderBy('created_at', 'desc')->first();
        DB::commit();
        return response()->json([
            'success' => true,
            'value' => $iframe
        ]);
    }
}
