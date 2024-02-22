<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\MyMail;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    /**
     * Handle attendance-related webhooks.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function attendance(Request $request)
    // {
    //     Log::channel('attendance')->info($request->all());

    //     return response()->json(['status' => true, 'res' => $request->all()], 200);
    // }
    
    public function attendance(Request $request)
    {
        Log::channel('attendance')->info($request->all());
    
        $classId = $request->classId;
        $attendanceData = $request->attendance;
    
        $attendanceDetails = [];
    
        foreach ($attendanceData as $attendance) {
            $userId = $attendance['userId'];
            $totalTime = $attendance['totalTime'];
            $startTime = $attendance['startTime'];
            $endTime = $attendance['endTime'];
            $check_u = DB::table('users')->where('mh_user_id',$userId)->first();
            if(isset($check_u)){
                $attendanceDetails[] = [
                    'class_id' => $classId,
                    'user_id' => $userId,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'total_time' => $totalTime,
                ];
            }
        }
    
        if (!empty($attendanceDetails)) {
            DB::table('book_class_attendance')->insert($attendanceDetails);
        }
        return response()->json(['status' => true, 'attendanceDetails' => $attendanceDetails], 200);
    }
}
