<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoinsHistory;
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
use App\Models\User;
use App\Models\ChoiceQuestion;
// use App\Models\LanguageList;

class QuestionAnswerController extends Controller
{
    public function index(Request $request) {
        $u_id = base64_decode($request->id);
        $student = DB::table('users')->where('user_type',3)->where('status',1)->get();
        $questions = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
        return view('admin.teacher.question-answer',compact('u_id','student','questions'));
    }

    public function index5(Request $request) {
        $id = $request->id;
        return view('admin.teacher.question-list', compact('id'));
    }





    public function index1(Request $request) {
        $u_id = base64_decode($request->id);
        $page_no = DB::table('choice_questions')->where('u_id',$u_id)->select('page')->groupBy('page')->get();
        $single_choice_radio = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_radio')->where('page',$request->page)->get();
        $single_choice_check = DB::table('choice_questions')->where('u_id',$u_id)->where('type','mult_choice')->where('page',$request->page)->get();
        $single_choice_drop = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_drop')->where('page',$request->page)->get();
        return view('admin.teacher.question_preview',compact('u_id','single_choice_radio','single_choice_check','single_choice_drop','page_no'));
    }
    public function create(Request $request)
    {

        $rules = [
            'welcome_text' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        $check = DB::table('welcome_pages')->where('u_id',$request->input('w_u_id'))->first();
        $t1 = DB::table('choice_questions')->where('id',$request->input('w_u_id'))->first();


        DB::beginTransaction();
        try{
            if($check){
                $data = [
                    'u_id' => $request->input('w_u_id'),
                    'teacher_id' => $t1->id,
                    'welcome_text' => $request->input('welcome_text'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('welcome_pages')->where('u_id',$request->input('w_u_id'))->update($data);
            }else{
                $data = [
                    'u_id' => $request->input('w_u_id'),
                    'teacher_id' => $t1->id,
                    'welcome_text' => $request->input('welcome_text'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('welcome_pages')->insert($data);
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

    public function single_create(Request $request)
    {
// return $request->all();
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'point' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        DB::beginTransaction();
        $ans = array();
        foreach($request->input('answer') as $an)
        {
            $ans[] = $request->input('option')[$an];
        }
        try{
                // $t1 = DB::table('users')->where('id',$request->input('s_u_id'))->first();
                // dd($t1);

                $data = [
                    'u_id' => $request->input('s_u_id'),
                    'course_id' => $request->input('course_id'),
                    'teacher_id' =>base64_decode($request->tid),
                    'welcome_id' => base64_decode($request->tid),
                    'question' => $request->input('question'),
                    'option' => implode(',',$request->input('option')),
                    'answer' => implode(',',$ans),
                    'type' => $request->input('question_type'),
                    'point' => $request->input('point'),
                    'page' => $request->input('page'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $quiz = DB::table('choice_questions')->insertGetId($data);

                $data2 = [
                    'quiz_id' => $quiz,
                    'u_id' => $request->input('s_u_id'),
                    'title' => 'Test Quiz ' . $request->input('id'),
                    'lession_id' => $request->input('course_id'),
                    'url' => $request->input('url'),
                    'is_completed' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('course_quizzes')->insert($data2);

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
    public function page(Request $request)
    {
        DB::beginTransaction();
        try{
                $check = DB::table('qa_pages')->where('u_id',$request->input('u_id'))->orderBy('created_at','DESC')->first();
                if($check){
                    $data = [
                        'u_id' => $request->input('u_id'),
                        'page_no'=> $check->page_no + 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    DB::table('qa_pages')->insert($data);
                }else{
                    $data = [
                        'u_id' => $request->input('u_id'),
                        'page_no'=> 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    DB::table('qa_pages')->insert($data);
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
    public function assign(Request $request)
    {

        $rules = [
            'student' => 'required',
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
                    'u_id' => $request->input('u_id'),
                    'teacher_id' => Auth::user()->id,
                    'student_id' => $request->student,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('student_questions')->insert($data);

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
    public function delquestion(Request $request){
        DB::table('choice_questions')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function delpage(Request $request){
        $page = DB::table('qa_pages')->where('id',$request->id)->first();
        DB::table('choice_questions')->where('page',$page->page_no)->delete();
        DB::table('qa_pages')->where('id',$request->id)->delete();
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    public function editq(Request $request){
        $data = DB::table('choice_questions')->where('id',$request->c_id)->first();
        // dd($request->c_id);
               return view('admin.teacher.question-answer-edit',compact('data'));
    }


    public function single_edit(Request $request)
    {
        // dd( $request->all());
        $data = DB::table('choice_questions')->where('id',$request->id)->first();
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'point' => 'required',
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
                    // 'u_id' => $request->input('s_u_id'),
                    // 'teacher_id' => Auth::user()->id,
                    // 'welcome_id' => Auth::user()->id,
                    'question' => $request->input('question'),
                    'option' => implode(',',$request->input('option')),
                    'answer' => implode(',',$request->input('answer')),
                    // 'type' => $request->input('question_type'),
                    'point' => $request->input('point'),
                    // 'page' => $request->input('page'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                // dd($data);
                DB::table('choice_questions')->where('id',$request->id)->update($data);
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
    public function delquiz(Request $request){

        DB::table('choice_questions')->where('u_id',$request->id)->delete();

        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }


    public function updateTitle(Request $request)
    {

        $id = $request->id;

        if($request->isMethod('get'))
        {
            $title = DB::table('choice_questions')->where('id',$id)->first();
            return view('admin.teacher.update_title' ,compact('title'));
        }

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

                    'title' => $request->input('title'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                // dd($data);
                DB::table('choice_questions')->where('id',$request->id)->update($data);
            DB::commit();
            return redirect('admin/teacher/question-list');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }





















    }
















