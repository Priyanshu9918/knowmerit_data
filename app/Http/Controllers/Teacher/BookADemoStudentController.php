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
use Mail;
use App\Models\Unavailability;
use App\Models\Availability;
use App\Models\BookSession;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Credit;
class BookADemoStudentController extends Controller
{

    public function student_cal_data(Request $request)
    {
        $t_timezone = DB::table('users')->where('id',Auth::user()->id)->first();
        $timezone = DB::table('time_zones')->where('id',$t_timezone->timezone)->first();
        $tz = $timezone->timezone ?? 'Asia/Kolkata';
        $tz1 = $timezone->raw_offset ?? '1.00';
        date_default_timezone_set($tz);

        $class_id   = $request->c_id;
        $sub_id   = $request->s_id;
        $teacher_id = Auth::user()->id;
        // $c_detail   = Pricing::where('id',$class_id)->first();

        $teacher_av = Availability::where('user_id', $teacher_id)->get();
        $interval   = '60';
        $interval   = (int)$interval;
        $day        = array();
        $events     = array();
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {

            $interval   = '60';

            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

            $st = Carbon::parse($startTime)->format('H:i');
            $end = Carbon::parse($endTime)->format('H:i');
            // dd($end);
            if($end == '00:00'){
                $interval   = '59';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-1 minutes");;
                $endTime1 = $endTime1->format('h:i A');

                $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
                $endTime->setTimezone(new \DateTimeZone($tz));

            }

            // if($end == '00:15'){
            //     $interval   = '44';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-16 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }
            // if($end == '00:20'){
            //     $interval   = '39';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-21 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:25'){
            //     $interval   = '34';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-26 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }
            
            if($end == '00:30'){
                $interval   = '29';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-31 minutes");
                $endTime1 = $endTime1->format('h:i A');

                $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
                $endTime->setTimezone(new \DateTimeZone($tz));

            }
            
            if ($startTime > $endTime) {
                // dd('yes ');
                // $startTime  = new \DateTime(date('Y-m-d').' '.$startTime->format('H:i:s'));
                // $endTime    = new \DateTime(date('Y-m-d').' '.$endTime->format('H:i:s'));
                $endTime = $endTime->modify('+1 day');
            }

            // dd(date('Y-m-d').' '.$t_av->time_from,date('Y-m-d').' '.$t_av->time_to);
            // dd($startTime,$endTime);
            while ($startTime < $endTime) {
                $st = $startTime->format('H:i:s');
                $et = $startTime->modify('+' . $interval . ' minutes');
                $et2 = $et->format('Y-m-d H:i:s');
                // echo strtotime($et2).'<='.strtotime($endTime->format('Y-m-d H:i:s')).'<br>';
                if (strtotime($et2) <= strtotime($endTime->format('Y-m-d H:i:s'))) {
                    // echo $st.'='.$et->format('H:i:s').''.strtotime($et2).'<br>';
                    $day[$t_av->day][] = array('from' => $st, 'to' => $et->format('H:i:s'), 'check' => '', 'f1' => $st, 't1' => $et->format('H:i:s'));
                }
            }
            // dd($day);

        }
        // dd($day);
       $s_date = strtotime(date('Y-m-d h:i a'));
        for($i=0;$i<=30;$i++)
        {
            $c_date = date('Y-m-d h:i A',strtotime('+'.$i.' days', $s_date));

            $d_date = date('D',strtotime('+'.$i.' days', $s_date));
            $d_date = strtolower($d_date);
            if(isset($day[$d_date]) && count($day[$d_date])>0)
            {
                foreach($day[$d_date] as $da)
                {
                    $s_time_01 = date('Y-m-d',strtotime($c_date)).' '.$da['from'];
                    $e_time_01 = date('Y-m-d',strtotime($c_date)).' '.$da['to'];

                    $start  = date('Y-m-d',strtotime($s_time_01)).'T'.date('H:i:00',strtotime($s_time_01));
                    $cate   = date('d M Y',strtotime($s_time_01)).' at '.date('h:i A',strtotime($s_time_01));
                    $end    = date('Y-m-d',strtotime($e_time_01)).'T'.date('H:i:00',strtotime($e_time_01));

                    $timeCom= strtotime(date('Y-m-d H:i',strtotime('+5 minutes',$s_date)));
                    $timeCom2= strtotime($s_time_01);
                    if ($timeCom < $timeCom2) {
                        $s_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                        $e_time_02 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];
                        //time convert into UTC
                        $time_from_t1   = new \DateTime($s_time_02, new \DateTimeZone($tz));
                        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
                        $s_time_02    = $time_from_t1->format("Y-m-d h:i A");

                        $time_to_t1   = new \DateTime($e_time_02, new \DateTimeZone($tz));
                        $time_to_t1->setTimezone(new \DateTimeZone('UTC'));
                        $e_time_02    = $time_to_t1->format("Y-m-d h:i A");

                        $check  = BookSession::where('teacher_id',$teacher_id)
                                            ->where(function($qry) use($s_time_02,$e_time_02) {
                                                $qry->orWhere(function($query) use($s_time_02,$e_time_02) {
                                                    $query->where('start_time','<=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                            ->where('end_time','<',date('Y-m-d H:i',strtotime($e_time_02)))
                                                            ->where('end_time','>',date('Y-m-d H:i',strtotime($s_time_02)));
                                                            // ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                                })
                                                ->orWhere(function($query) use($s_time_02,$e_time_02) {
                                                    $query->where('start_time','>=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                            ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                                })
                                                ->orWhere(function($query) use($s_time_02,$e_time_02) {
                                                    $query->where('start_time','<=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                            ->where('end_time','>=',date('Y-m-d H:i',strtotime($e_time_02)));
                                                });
                                            })->where('is_cancelled',0)
                                              ->where('teacher_url','<>',null)
                                            ->first();

                        // dd($s_time_02);
                        // $check = null;
                        if ($check == null) {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Available Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['A', 'B', 'C'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'green',
                                'hereText'   => 'TEXT TEST',
                            );
                        }else{
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Booked Slot',
                                'body'      => $cate,
                                'start'     => $start,
                                'end'       => $end,
                                'location'  => 'Meeting Room A',
                                'attendees' => ['D', 'D'],
                                'category'  => 'time',
                                'state'     => 'Free',
                                'color'     => '#fff',
                                'text01'    => $cate,
                                'backgroundColor' => 'grey',
                                'hereText'   => 'TEXT TEST',
                            );
                        }
                    }
                }
            }
        }
        //Find Unavailability
        // date_default_timezone_set('UTC');
        // $unavailable = Unavailability::where('teacher_id',$teacher_id)->where('start_time','>=',date('Y-m-d H:i:00'))->get();
        // // dd($unavailable);
        // date_default_timezone_set($tz);
        // foreach($unavailable as $un)
        // {
        //     $b_time_from   = new \DateTime($un->start_time, new \DateTimeZone('UTC'));
        //                     $b_time_to     = new \DateTime($un->end_time, new \DateTimeZone('UTC'));

        //                     $b_time_from->setTimezone(new \DateTimeZone($tz));
        //                     $b_time_to->setTimezone(new \DateTimeZone($tz));

        //                     $tf_time    = $b_time_from->format("Y-m-d H:i");
        //                     $tt_time    = $b_time_to->format("Y-m-d H:i");

        //     $events[] = array(  'id'        =>'1',
        //                     'calendarId'=> 'cal1',
        //                     'title'     => 'Unavailable',
        //                     'body'      => '',
        //                     'start'     => str_replace(' ','T',$tf_time),
        //                     'end'       => str_replace(' ','T',$tt_time),
        //                     'location'  => 'Meeting Room A',
        //                     'attendees' => ['B', 'B' , 'C'],
        //                     'category'  => 'time',
        //                     'state'     => 'Free',
        //                     'color'     => '#fff',
        //                     'text01'    => '',
        //                     'backgroundColor' => 'red',
        //                     'customStyle' => [
        //                         'z-index' => '999999',
        //                     ],
        //                 );
        // }
        // dd($events);

        $html = view('front.teacher.cal4', compact('events', 'tz', 'tz1','class_id','sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id'=>$class_id ,'sub_id'=>$sub_id]);
    }
    public function student_booking_demo(Request $req)
    {
        // dd($req->all());
        $t_timezone = DB::table('users')->where('id',$req->teacher_id)->first();
        $timezone = null;
        if($t_timezone!=null)
        {
            $timezone = DB::table('time_zones')->where('id',$t_timezone->timezone)->first();
        }

        $tz = $timezone->timezone ?? 'Asia/Kolkata';
        $tz1 = $timezone->raw_offset ?? '1.00';

        $date_time  = str_replace('at ', '', $req->get('date_time'));

        $time_from_t1   = new \DateTime($date_time, new \DateTimeZone($tz));
        $time_from_t1->setTimezone(new \DateTimeZone('UTC'));
        $tf_time        = $time_from_t1->format("Y-m-d h:i A");

        // $c_detail   = Pricing::where('id',$req->get('class_id'))->first();

        $start_time = date('Y-m-d H:i', strtotime($tf_time));
        // $interval   = ($c_detail!=null && $c_detail->time!=null)?$c_detail->time:'00';
        $interval   = '60';
        $end_time   = date('Y-m-d H:i', strtotime('+' . $interval . ' minutes', strtotime($tf_time)));

        $randomNumber = random_int(1000000, 9999999);

        $insert_arr = array(
            'class_id'      => $req->get('class_id'),
            'sub_id'      => $req->get('sub_id'),
            'student_id'    => $req->get('student_id'),
            'teacher_id'    => $req->get('teacher_id'),
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'duration'      => $interval,
            'created_at'    => Carbon::now()
        );

        $insert_id  = BookSession::create($insert_arr)->id;
        if ($insert_id != null) {
            $url = route('teacher.student.book.session.merithub', $insert_id);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }

    public function student_merithub_create_class(Request $request)
    {
        // dd($request->id);
        $check = BookSession::find($request->id);
        if ($check != null) {
            DB::beginTransaction();
            try {
                //MeritHubIntegration here
                $merithub  = DB::table('merithub_creditionals')->first();
                $t_user    = DB::table('users')->where('id', $check->teacher_id)->first();
                $s_user    = DB::table('users')->where('id', $check->student_id)->first();
                // $tutor     = DB::table('teacher_settings')->where('user_id', $check->teacher_id)->first();
                // $student   = DB::table('student_details')->where('user_id', $check->student_id)->first();

                $tutor     = DB::table('users')->where('id',$check->teacher_id)->first();
                $tutor_img = ($tutor!=null && $tutor->avatar!=null)? url('uploads/tutors/').'/'.$tutor->avatar:'https://www.knowmerit.com/assets/img/logo/logo.png';

                $student   = DB::table('users')->where('id',$check->student_id)->first();
                $student_img = ($student!=null && $student->avatar!=null)? url('uploads/tutors/').'/'.$student->avatar:'https://www.knowmerit.com/assets/img/logo/logo.png';

                $tt        = ($tutor!=null && $tutor->timezone!=null)?$tutor->timezone:'195';
                $timezone1 = DB::table('time_zones')->where('id',$tt)->first();
                $st        = ($student!=null && $student->timezone!=null)?$student->timezone:'195';
                $timezone  = DB::table('time_zones')->where('id',$st)->first();

                // $tt        = 195;
                // $timezone1 = 'Asia/Kolkata';
                // $st        = 195;
                // $timezone  = 'Asia/Kolkata';
                $timesx     = $check->start_time;

                $tz        = $timezone->timezone;

                $t1        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t1->setTimezone(new \DateTimeZone($tz));
                $times     = $t1->format("Y-m-d h:i A");

                $t2        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t2->setTimezone(new \DateTimeZone($timezone1->timezone));
                $times2    = $t2->format("Y-m-d h:i A");

                $startTime = date('Y-m-d', (strtotime($times))) . 'T' . date('H:i:s', (strtotime($times)));

                $headers   = array("content-type: application/json", "Authorization:" . $merithub->merithub_token);


                if (empty($t_user->mh_user_id)) {
                    $url    = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";
                    $data   = array(
                        "name" => $t_user->name,
                        "img" => $tutor_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $t_user->id,
                        "email" => $t_user->email,
                        "role" => "M",
                        "timeZoneId" => $timezone1->timezone,
                        "permission" => "CJ"
                    );

                    $post_data  = json_encode($data);

                    $curl       = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    $result = curl_exec($curl);
                    curl_close($curl);

                    $getUserId      = json_decode($result);
                    $mh_user_id     = $getUserId->userId;
                    $update         = DB::table('users')->where('id', $t_user->id)->update(['mh_user_id' => $mh_user_id]);
                }
                else
                {
                    $mh_user_id = $t_user->mh_user_id;

                    $this->meritHubUserUpdate($merithub->client_id, $mh_user_id, $tutor_img, $timezone1->timezone, $t_user, $headers);
                    // die('end');
                }

                if (empty($s_user->mh_user_id)) {
                    // dd($merithub->client_id);
                    $url2   = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";

                    $data2  = array(
                        "name" => $s_user->name,
                        "img" => $student_img,
                        "lang" => "en",
                        "clientUserId" => "Knowmerit" . $s_user->id,
                        "email" => $s_user->email,
                        "role" => "M",
                        "timeZoneId" =>$timezone->timezone,
                        "permission" => "CJ"
                    );

                    $post_data2 = json_encode($data2);

                    $curl2      = curl_init($url2);
                    curl_setopt($curl2, CURLOPT_URL, $url2);
                    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl2, CURLOPT_POST, 1);
                    curl_setopt($curl2, CURLOPT_POSTFIELDS, $post_data2);
                    curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
                    $result2 = curl_exec($curl2);
                    curl_close($curl2);

                    $getUserId2  = json_decode($result2);
                    // dd($getUserId2);
                    $mh_user_id2 = $getUserId2->userId;
                    $update      = DB::table('users')->where('id', $s_user->id)->update(['mh_user_id' => $mh_user_id2]);
                } else {
                    $mh_user_id2 = $s_user->mh_user_id;

                        $this->meritHubUserUpdate($merithub->client_id, $mh_user_id2, $student_img, $timezone->timezone, $s_user, $headers);
                    }

                // Schedule Class CURL
                $url1     = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $mh_user_id . "";

                $data1 = array(
                    "title" => $s_user->name . ' ' . 'Session',
                    "startTime" => $startTime,
                    "recordingDownload" => false,
                    "downloadRecording" => false,
                    "duration" => $check->duration,
                    "lang" => "en",
                    "timeZoneId" => $timezone->timezone,
                    "type" => "oneTime",
                    "access" => "private",
                    "login" => false,
                    "layout" => "CR",
                    "status" => "up",
                    "recording" => array("record" => false, "autoRecord" => false, "recordingControl" => true)
                );

                $post_data1 = json_encode($data1);
                $curl1 = curl_init($url1);
                curl_setopt($curl1, CURLOPT_URL, $url1);
                curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl1, CURLOPT_POST, 1);
                curl_setopt($curl1, CURLOPT_POSTFIELDS, $post_data1);
                curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
                $result1 = curl_exec($curl1);
                curl_close($curl1);

                $getClass = json_decode($result1);
                // dd($getClass);
                $classId               = $getClass->classId;
                $TutorJoinLink         = $getClass->hostLink;
                $commonParticipantLink = $getClass->commonLinks->commonParticipantLink;
                // End Schedule Class CURL
                // dd($commonParticipantLink);

                $url3       = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $classId . "/users";
                $data3      = array("users" => array(array("userId" => $mh_user_id2, "userLink" => $commonParticipantLink, "userType" => "su", "timeZoneId" => $timezone1->timezone,)));
                $post_data3 = json_encode($data3);

                $curl3      = curl_init($url3);
                curl_setopt($curl3, CURLOPT_URL, $url3);
                curl_setopt($curl3, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl3, CURLOPT_POST, 1);
                curl_setopt($curl3, CURLOPT_POSTFIELDS, $post_data3);
                curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
                $result3 = curl_exec($curl3);
                curl_close($curl3);
                $getSession = json_decode($result3);
                $StudentJoinLink = $getSession[0]->userLink;

                $common   = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $commonParticipantLink;
                $TutorJoinLink   = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $TutorJoinLink;
                $StudentJoinLink = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $StudentJoinLink;
                $RecordingURL    = "https://merithub.com/" . $merithub->client_id . "/sessions/view/" . $classId . "/" . $commonParticipantLink;
                // End MerihHub Integration

                //Decrease credit
                Credit::where(['student_id' => auth()->user()->id, 'teacher_id' => $check->teacher_id])->decrement('credit', 1);

                // Update book Session
                $check->merithub_class_id = $classId;
                $check->student_url = $StudentJoinLink;
                $check->teacher_url = $TutorJoinLink;
                $check->common_url  = $common;
                $check->record_url  = $RecordingURL;
                $check->is_booked   = 1;
                $check->save();

                $class_details = DB::table('categories')->where('id',$check->class_id)->first();
                // Email for student
                $email =
                    [
                        'sender_email' => $s_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        's_name' => $s_user->name,
                        't_name' => $t_user->name,
                        'student_url' => $StudentJoinLink,
                        'title' => 'Student Class Booking Email',
                        'class_time' => $times,
                        'class_name' => $class_details->name,
                    ];
                // dd($email);
                Mail::send('mail.student-booking', $email, function ($messages) use ($email) {
                    $messages->to($email['sender_email'])
                        ->from($email['inext_email'], 'Know-merit');
                    $messages->subject("Class Booking Confirmation.");
                });

                // Email for Teacher
                $email2 =
                    [
                        'sender_email' => $t_user->email,
                        'inext_email' => env('MAIL_USERNAME'),
                        't_name' => $t_user->name,
                        's_name' => $s_user->name,
                        'teacher_url' => $TutorJoinLink,
                        'title' => 'Successfully Registered!',
                        'class_time' => $times2,
                        'class_name' => $class_details->name,

                    ];

                    Mail::send('mail.teacher-booking', $email2, function ($messages) use ($email2) {
                        $messages->to($email2['sender_email'])
                            ->from($email2['inext_email'], 'Know-merit');
                        $messages->subject("New Lesson Booking.");
                    });

                DB::commit();
                return redirect()->route('student.student-dashboard')->with('success', 'Class created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                echo '<b>ERROR : </b>' . $e; //$e->getMessage()
                die;
            }
        } else {
            return redirect()->route('student.student-dashboard')->with('error', 'Oops something went wrong');
        }
    }
    public function meritHubUserUpdate($c_id, $mu_id, $u_img, $tz, $u_data, $headers){

        $url    = "https://serviceaccount1.meritgraph.com/v1/".$c_id."/users/".$mu_id;
        $data   = array("name"=>$u_data->name,
                        "img"=> $u_img,
                        "lang"=>"en",
                        "clientUserId"=>"LATOGO-".$u_data->id,
                        "email"=>$u_data->email,
                        "role"=>"M",
                        "timeZoneId"=>$tz,
                        "permission"=>"CJ"
                    );

        $post_data  = json_encode($data);

        $curl       = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        curl_close($curl);

        // dd($result);
        return true;
    }
}
