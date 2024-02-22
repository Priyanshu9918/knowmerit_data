<?php

namespace App\Http\Controllers\student;

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
// use App\Models\LanguageList;

class QuestionAnswerController extends Controller
{
    public function index1(Request $request) {
        $u_id = base64_decode($request->id);
        $page = $request->page;
        $question = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
        $question1 = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page+1)->get();
        // $single_choice_radio = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_radio')->where('page',$request->page)->get();
        // $single_choice_check = DB::table('choice_questions')->where('u_id',$u_id)->where('type','mult_choice')->where('page',$request->page)->get();
        // $single_choice_drop = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_drop')->where('page',$request->page)->get();
        $questions = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
        return view('front.student.question-preview',compact('u_id','questions','question','page','question1'));
    }
    public function index(Request $request) {
        $u_id = $request->id;
        $page = $request->page;
        // dd($u_id);
        $question = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
        $question1 = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page+1)->get();
        // dd($question);
        // $single_choice_radio = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_radio')->where('page',$request->page)->get();
        // $single_choice_check = DB::table('choice_questions')->where('u_id',$u_id)->where('type','mult_choice')->where('page',$request->page)->get();
        // $single_choice_drop = DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_drop')->where('page',$request->page)->get();
        $questions = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
        // return view('front.student.q_preview',compact('u_id','single_choice_radio','single_choice_check','single_choice_drop','question','page'));
        $html = view('front.student.q_preview', compact('u_id','questions','question','page','question1'))->render();
        return json_encode(['status' => true, 'html' => $html]);
    }

    public function ans(Request $request)
    {
        // dd($request->all());
        $rules = [
            'ans' => 'nullable',
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

            $answer = $request->ans;
            // dd($answer);
            foreach($answer as $ans){
                foreach ($ans as $singleAnswer) {
                $ansz = explode('~',$singleAnswer);
                $ans1= $ansz[0];
                $q_id1 = $ansz[1];
                // dd($ans1);
                $data = [
                    'u_id' => $request->u_id,
                    'student_id' => Auth::user()->id,
                    'question_no' => $q_id1,
                    'ans' => $ans1,
                ];

                DB::table('submit_question_students')->insert($data);
            }
        }
            // dd($data);
            $data1 = [
                'is_submitted' => 1,
            ];
            DB::table('student_questions')->where('u_id',$request->u_id)->where('student_id',Auth::user()->id)->update($data1);

         // Checking if course_id exists in choice_questions
            $courseExists = DB::table('choice_questions')
            ->where('u_id', $request->u_id)
            ->first();

            DB::commit();
            if(isset($courseExists)){
                return response()->json([
                    'success2' => true,
                    'u_id' => $request->u_id
                ]);
            }else
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


    public function result(Request $request)
{
    $u_id = base64_decode($request->id);

    $studentAnswers = DB::table('submit_question_students')
        ->where('u_id', $u_id)
        ->get();

    $correctAnswers = DB::table('choice_questions')
        ->where('u_id', $u_id)
        ->pluck('answer', 'id')
        ->all();

    $correctAnswerCount = 0;
    $countedQuestions = [];

    foreach ($studentAnswers as $studentAnswer) {
        $q_id = $studentAnswer->question_no;
        $studentGivenAnswer = $studentAnswer->ans;

        if (!in_array($q_id, $countedQuestions) && isset($correctAnswers[$q_id]) && in_array($studentGivenAnswer, explode(',', $correctAnswers[$q_id]))) {
            $correctAnswerCount++;
            $countedQuestions[] = $q_id;
        }
    }

    return view('front.student.result', [
        'success' => true,
        'correct_answer_count' => $correctAnswerCount
    ]);
}




//     public function result(Request $request)
// {
//     $u_id = base64_decode($request->id);

//     $studentAnswers = DB::table('submit_question_students')
//         ->where('u_id', $u_id)
//         ->get();

//     $correctAnswerCount = 0;

//     foreach ($studentAnswers as $studentAnswer) {
//         $q_id = $studentAnswer->question_no;
//         $correctAnswer = DB::table('choice_questions')
//             // ->where('u_id', $u_id)
//             ->where('id', $q_id)
//             ->select('answer')
//             ->first();

//             if ($correctAnswer && $studentAnswer->ans === $correctAnswer->answer) {
//                 $correctAnswerCount++;
//             }
//         }
//     return view('front.student.result', [
//         'success' => true,
//         'correct_answer_count' => $correctAnswerCount
//     ]);
// }


public function submitPreview(Request $request) {
    $u_id = base64_decode($request->id);
    $page = $request->page;
    $page_no = DB::table('choice_questions')->where('u_id',$u_id)->select('page')->groupBy('page')->get();
    $question = DB::table('choice_questions')->where('u_id',$u_id)->get();
    $question1 = DB::table('choice_questions')->where('u_id',$u_id)->get();
    $questions = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$request->page)->get();
    $answers = DB::table('submit_question_students')
    ->leftJoin('choice_questions', function($join) {
        $join->on('submit_question_students.u_id', '=', 'choice_questions.u_id')
             ->on('submit_question_students.question_no', '=', 'choice_questions.id');
    })
    ->select('submit_question_students.*', 'choice_questions.answer', 'choice_questions.type', 'choice_questions.u_id')
    ->where('submit_question_students.u_id', $u_id)
    ->get();

    // dd($answers1);
    return view('front.student.submit-preview',compact('u_id','questions','question','page','question1','answers','page_no'));
}
}
