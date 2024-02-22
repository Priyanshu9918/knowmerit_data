<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\StudentMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Book_a_class;
use App\Models\Student;
use Mail;
use App\Models\Availability;
use App\Models\BookSession;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function studentdashboard(Request $request)
    {
        return view('front.student.dashboard');
    }
    public function mcqs(Request $request)
    {
        $id = base64_decode($request->id);

        $mcq = Db::table('mcqs')->where('mcq_type_id',$id)->get();

        return view('front.student.mcqs',compact('mcq'));
    }
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $teacher_id = DB::table('student_mcqs')->where('mcq_id',$request->type_id)->where('student_id',Auth::user()->id)->first();

            $ans = $request->ans;
            for($i=0; $i < count($ans); $i++){
                $que = $request->mcq_id[$i];
                $data = [
                    'student_id' => Auth::user()->id,
                    'teacher_id' => $teacher_id->teacher_id,
                    'mcq_type_id' => $request->type_id,
                    'question_id' => $que,
                    'answer' => $ans[$que],
                    'created_at' =>date('Y-m-d H:i:s'),
                ];
                DB::table('submit_mcqs')->insert($data);
            }
            $data1 = [
                'status' => 0,
            ];
            DB::table('student_mcqs')->where('mcq_id',$request->type_id)->where('student_id',Auth::user()->id)->update($data1);

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
    public function classmeeting(Request $request)
    {
        $id = base64_decode($request->id);
        return view('front.student.meeting-jisti',compact('id'));
    }
    public function mathpad(Request $request)
    {
        return view('front.student.math');
        // return json_encode(['status' => true, 'html' => $html]);
    }
//////////delete student////////
public function index(Request $request) {
    $user = Auth::user();
    // dd($user);
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

    $status = $request->input('status');
 // dd($status);
    try {
        if ($status == 1) {
            DB::table('users')->where('id',Auth::user()->id)->delete();
            $user = DB::table('students')->where('user_id',Auth::user()->id)->first();
            if($user){
                DB::table('students')->where('user_id',Auth::user()->id)->delete();
            }else{
                DB::table('book_a_classes')->where('user_id',Auth::user()->id)->delete();
            }

            $message = 'Account deactivated successfully.';
            return response()->json(['success' => true, 'message' => $message]);

        }

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while processing your request.']);
    }
}
public function addreason(Request $request)
{
    $rules = [
        'issue' => 'required',
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


        $data1 = [
            'issue' => $request->input('issue'),
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        DB::table('user_raise_reason')->insert($data1);

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
