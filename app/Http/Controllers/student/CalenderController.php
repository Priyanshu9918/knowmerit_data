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
use Mail;
use App\Models\Unavailability;
use App\Models\Availability;
use App\Models\BookSession;
use Carbon\Carbon;
use App\Models\Credit;
class CalenderController extends Controller
{

    public function cal_data(Request $request)
    {
        // dd($request->all());
        // date_default_timezone_set("Europe/Paris");
        $tz_f   = 195;
        $tz     = 'Asia/Kolkata';
        $tz1    = '1.00';
        date_default_timezone_set($tz);

        $class_id   = $request->c_id;
        $sub_id   = $request->s_id;
        $teacher_id = $request->t_id;
        // $c_detail   = Pricing::where('id',$class_id)->first();

        $teacher_av = Availability::where('user_id', $teacher_id)->get();
        $interval   = '60';
        $interval   = (int)$interval;
        $day        = array();
        $events     = array();
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {

            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

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
        for ($i = 0; $i <= 30; $i++) {
            $c_date = date('Y-m-d h:i A', strtotime('+' . $i . ' days', $s_date));
            $d_date = date('D', strtotime('+' . $i . ' days', $s_date));
            $d_date = strtolower($d_date);
            if (isset($day[$d_date]) && count($day[$d_date]) > 0) {
                foreach ($day[$d_date] as $da) {
                    $s_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                    $e_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];

                    $start  = date('Y-m-d', strtotime($s_time_01)) . 'T' . date('H:i:00', strtotime($s_time_01));
                    $cate   = date('d M Y', strtotime($s_time_01)) . ' at ' . date('h:i A', strtotime($s_time_01));
                    $end    = date('Y-m-d', strtotime($e_time_01)) . 'T' . date('H:i:00', strtotime($e_time_01));

                    $timeCom = strtotime(date('Y-m-d H:i', strtotime('+24 hour', $s_date)));
                    $timeCom2 = strtotime($s_time_01);

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

                        $check  = BookSession::where(function ($qry) use ($s_time_02, $e_time_02) {
                            $qry->whereDate('start_time', '>=', date('Y-m-d', strtotime($s_time_02)))
                                ->whereTime('start_time', '>=', date('H:i:00', strtotime($s_time_02)));
                            $qry->whereDate('end_time', '>=', date('Y-m-d', strtotime($e_time_02)))
                                ->whereTime('end_time', '>=', date('H:i:00', strtotime($e_time_02)));
                        })->first();

                        // dd($s_time_02);
                        // $check = null;
                        if ($check == null) {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Avalable Slot',
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

        $html = view('front.student.cal1', compact('events', 'tz', 'tz1','class_id','sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id'=>$class_id ,'sub_id'=>$sub_id]);
    }

    public function book_session(Request $req)
    {
        // dd($req->all());
        // dd($req->all());
        // $tz_f   = Auth::user()->load('StudentDetail.TimeZone');
        // $tz     = ($tz_f->StudentDetail != null && $tz_f->StudentDetail->TimeZone!=null)?$tz_f->StudentDetail->TimeZone->timezone:'Asia/Kolkata';
        // $tz1    = ($tz_f->StudentDetail != null && $tz_f->StudentDetail->TimeZone!=null)?$tz_f->StudentDetail->TimeZone->raw_offset:'1.00';
        $tz_f   = 195;
        $tz     = 'Asia/Kolkata';
        $tz1    = '1.00';

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
            'student_url'    => $randomNumber,
            'teacher_url'    => $randomNumber,
            'duration'      => $interval,
            'created_at'    => Carbon::now()
        );

        $insert_id  = BookSession::create($insert_arr)->id;
        if ($insert_id != null) {
            $url = route('student.book.session.merithub', $insert_id);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }

    // public function merithub_create_class(Request $req)
    // {
    //     echo 'here implement and redirect to my-classis';
    // }

    public function merithub_create_class(Request $request)
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
                $tt        = 195;
                $timezone1 = 'Asia/Kolkata';
                $st        = 195;
                $timezone  = 'Asia/Kolkata';
                $timesx     = $check->start_time;

                $tz        = 'Asia/Kolkata';

                $t1        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t1->setTimezone(new \DateTimeZone($tz));
                $times     = $t1->format("Y-m-d h:i A");

                $t2        = new \DateTime($timesx, new \DateTimeZone('UTC'));
                $t2->setTimezone(new \DateTimeZone('Asia/Kolkata'));
                $times2    = $t2->format("Y-m-d h:i A");

                $startTime = date('Y-m-d', (strtotime($times))) . 'T' . date('H:i:s', (strtotime($times)));

                $headers   = array("content-type: application/json", "Authorization:" . $merithub->merithub_token);


                if (empty($t_user->mh_user_id)) {
                    $url    = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";
                    $data   = array(
                        "name" => $t_user->name,
                        "img" => "https://proexceedu.com/public/assets/images/logo.png",
                        "lang" => "en",
                        "clientUserId" => "PRO-EX" . $t_user->id,
                        "email" => $t_user->email,
                        "role" => "M",
                        "timeZoneId" => 'Asia/Kolkata',
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
                } else {
                    $mh_user_id = $t_user->mh_user_id;
                }

                if (empty($s_user->mh_user_id)) {
                    // dd($merithub->client_id);
                    $url2   = "https://serviceaccount1.meritgraph.com/v1/" . $merithub->client_id . "/users";

                    $data2  = array(
                        "name" => $s_user->name,
                        "img" => "https://proexceedu.com/public/assets/images/logo.png",
                        "lang" => "en",
                        "clientUserId" => "PRO-EX" . $s_user->id,
                        "email" => $s_user->email,
                        "role" => "M",
                        "timeZoneId" => 'Asia/Kolkata',
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
                    "timeZoneId" => 'Asia/Kolkata',
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

                $url3       = "https://class1.meritgraph.com/v1/" . $merithub->client_id . "/" . $classId . "/users";
                $data3      = array("users" => array(array("userId" => $mh_user_id2, "userLink" => $commonParticipantLink, "userType" => "su", "timeZoneId" => 'Asia/Kolkata',)));
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

                $TutorJoinLink   = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $TutorJoinLink;
                $StudentJoinLink = "https://live.merithub.com/info/room/" . $merithub->client_id . "/" . $StudentJoinLink;
                $RecordingURL    = "https://merithub.com/" . $merithub->client_id . "/sessions/view/" . $classId . "/" . $commonParticipantLink;
                // End MerihHub Integration

                //Decrease credit
                Credit::where(['student_id' => auth()->user()->id, 'teacher_id' => $check->teacher_id])->decrement('credit', 1);

                // Update book Session
                $check->student_url = $StudentJoinLink;
                $check->teacher_url = $TutorJoinLink;
                $check->record_url  = $RecordingURL;
                $check->is_booked   = 1;
                $check->save();


                // Email for student
                // $email =
                //     [
                //         'sender_email' => $s_user->email,
                //         'inext_email' => env('MAIL_USERNAME'),
                //         'name' => $s_user->name,
                //         'title' => 'Successfully Registered!',
                //         'class_time' => $times,
                //         'class_durection' => $check->duration
                //     ];

                // Mail::send('email.student-when-book-a-class', $email, function ($messages) use ($email) {
                //     $messages->to($email['sender_email'])
                //         ->from($email['inext_email'], 'Latogo');
                //     $messages->subject("Latogo Class Confirmation");
                // });

                //Email for Teacher
                // $email2 =
                //     [
                //         'sender_email' => $t_user->email,
                //         'inext_email' => env('MAIL_USERNAME'),
                //         'name' => $t_user->name,
                //         's_name' => $s_user->name,
                //         'title' => 'Successfully Registered!',
                //         'class_time' => $times2,
                //         'class_durection' => $check->duration
                //     ];

                // Mail::send('email.when-student-book-a-lesson-then-need-to-send-email-to-teacher', $email2, function ($messages) use ($email2) {
                //     $messages->to($email2['sender_email'])
                //         ->from($email2['inext_email'], 'Latogo');
                //     $messages->subject("Latogo Class Confirmation");
                // });

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

    public function cal_data1(Request $request)
    {
        // dd($request->all());
        // date_default_timezone_set("Europe/Paris");
        $tz_f   = 195;
        $tz     = 'Asia/Kolkata';
        $tz1    = '1.00';
        date_default_timezone_set($tz);

        $class_id   = $request->c_id;
        $sub_id   = $request->s_id;
        $teacher_id = $request->t_id;
        // $c_detail   = Pricing::where('id',$class_id)->first();

        $teacher_av = Availability::where('user_id', $teacher_id)->get();
        $interval   = '60';
        $interval   = (int)$interval;
        $day        = array();
        $events     = array();
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {

            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

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
        for ($i = 0; $i <= 30; $i++) {
            $c_date = date('Y-m-d h:i A', strtotime('+' . $i . ' days', $s_date));
            $d_date = date('D', strtotime('+' . $i . ' days', $s_date));
            $d_date = strtolower($d_date);
            if (isset($day[$d_date]) && count($day[$d_date]) > 0) {
                foreach ($day[$d_date] as $da) {
                    $s_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['from'];
                    $e_time_01 = date('Y-m-d', strtotime($c_date)) . ' ' . $da['to'];

                    $start  = date('Y-m-d', strtotime($s_time_01)) . 'T' . date('H:i:00', strtotime($s_time_01));
                    $cate   = date('d M Y', strtotime($s_time_01)) . ' at ' . date('h:i A', strtotime($s_time_01));
                    $end    = date('Y-m-d', strtotime($e_time_01)) . 'T' . date('H:i:00', strtotime($e_time_01));

                    $timeCom = strtotime(date('Y-m-d H:i', strtotime('+24 hour', $s_date)));
                    $timeCom2 = strtotime($s_time_01);

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

                        $check  = BookSession::where(function ($qry) use ($s_time_02, $e_time_02) {
                            $qry->whereDate('start_time', '>=', date('Y-m-d', strtotime($s_time_02)))
                                ->whereTime('start_time', '>=', date('H:i:00', strtotime($s_time_02)));
                            $qry->whereDate('end_time', '>=', date('Y-m-d', strtotime($e_time_02)))
                                ->whereTime('end_time', '>=', date('H:i:00', strtotime($e_time_02)));
                        })->first();

                        // dd($s_time_02);
                        // $check = null;
                        if ($check == null) {
                            $events[] = array(
                                'id'        => '1',
                                'calendarId' => 'cal1',
                                'title'     => 'Avalable Slot',
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

        $html = view('front.student.cal2', compact('events', 'tz', 'tz1','class_id','sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id'=>$class_id ,'sub_id'=>$sub_id]);
    }

}
