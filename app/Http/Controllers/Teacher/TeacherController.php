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
class TeacherController extends Controller
{
    public function mcqs(Request $request)
    {
        $id = base64_decode($request->id);

        $mcq = Db::table('mcqs')->where('mcq_type_id',$id)->get();

        return view('front.teacher.mcqs',compact('mcq'));
    }
    public function calendar(Request $request)
    {
        $user_id = base64_decode($request->id);
        $day['sun'] = [];
        $day['mon'] = [];
        $day['tue'] = [];
        $day['wed'] = [];
        $day['thu'] = [];
        $day['fri'] = [];
        $day['sat'] = [];
        $events     = [];

        $user   = User::where('id',auth()->user()->id)->first();
        $tz     = DB::table('time_zones')->where('id',$user->timezone ?? 195)->first();
        $tz1    = $tz->raw_offset;
        $tz     = $tz->timezone;
        date_default_timezone_set($tz);
        // $tz1 = 1.0;
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // date_default_timezone_set($tz);

        $times1 = Availability::where(['user_id'=>$user_id,'day'=>'sun'])->get();
        $times2 = Availability::where(['user_id'=>$user_id,'day'=>'mon'])->get();
        $times3 = Availability::where(['user_id'=>$user_id,'day'=>'tue'])->get();
        $times4 = Availability::where(['user_id'=>$user_id,'day'=>'wed'])->get();
        $times5 = Availability::where(['user_id'=>$user_id,'day'=>'thu'])->get();
        $times6 = Availability::where(['user_id'=>$user_id,'day'=>'fri'])->get();
        $times7 = Availability::where(['user_id'=>$user_id,'day'=>'sat'])->get();

        $teacher_av = Availability::where('user_id',$user_id)->get();

        foreach($teacher_av as $t_av)
        {
            $time_from  = date('Y-m-d').' '.$t_av->time_from;
            $time_to    = date('Y-m-d').' '.$t_av->time_to;

            $time_from_t1   = new \DateTime($time_from, new \DateTimeZone('UTC'));
            $time_to_t1     = new \DateTime($time_to, new \DateTimeZone('UTC'));

            $time_from_t1->setTimezone(new \DateTimeZone($tz));
            $time_to_t1->setTimezone(new \DateTimeZone($tz));

            $tf_time    = $time_from_t1->format("h:i A");
            $tt_time    = $time_to_t1->format("h:i A");

            $day[$t_av->day][] = array('from'=>$tf_time,'to'=>$tt_time,'raw_from'=>$t_av->time_from,'raw_to'=>$t_av->time_to,'check'=>'');
        }
        // dd($day);
        $s_date = strtotime(date('Y-m-d h:i A'));
        for($i=0;$i<=30;$i++)
        {
            $c_date = date('Y-m-d h:i A',strtotime('+'.$i.' days', $s_date));
            $d_date = date('D',strtotime('+'.$i.' days', $s_date));
            $d_date = strtolower($d_date);
            if(isset($day[$d_date]) && count($day[$d_date])>0)
            {
                foreach($day[$d_date] as $da)
                {
                    // dd($da['from']);
                    $s_time_01 = date('Y-m-d',strtotime($c_date)).' '.$da['from'];
                    $e_time_01 = date('Y-m-d',strtotime($c_date)).' '.$da['to'];

                    $s_time_02 = date('Y-m-d',strtotime($c_date)).' '.$da['raw_from'];
                    $e_time_02 = date('Y-m-d',strtotime($c_date)).' '.$da['raw_to'];

                    $start  = date('Y-m-d',strtotime($s_time_01)).'T'.date('H:i:00',strtotime($s_time_01));
                    $cate   = date('d M Y',strtotime($s_time_01)).' at '.date('h:i A',strtotime($s_time_01));
                    $end    = date('Y-m-d',strtotime($e_time_01)).'T'.date('H:i:00',strtotime($e_time_01));

                    $check  = null; //date('Y-m-d',strtotime($s_time_01)).' '.date('H:i:00',strtotime($s_time_01));

                    // $check  = BookSession::whereDate('start_time',date('Y-m-d',strtotime($s_time_02)))
                    //                         ->whereTime('start_time',date('H:i:00',strtotime($s_time_02)))
                    //                         ->first();
                    $name = $img = '';
                    if($check!=null)
                    {
                        // dd($check->Student->StudentDetail);
                        $name   = $check->Student->name;
                        $img    = ($check->Student!=null && $check->Student->StudentDetail!=null && $check->Student->StudentDetail->avtar!=null)?asset('uploads/user/avatar/'.$check->Student->StudentDetail->avtar):asset('assets/img/user/user.png');
                    }

                    $events[] = array(  'id'        =>'1',
                                        'calendarId'=> 'cal1',
                                        'title'     => ($check!=null)?'Booked':'Available',
                                        'body'      => $cate,
                                        'start'     => $start,
                                        'end'       => $end,
                                        'location'  => 'Meeting Room A',
                                        'attendees' => [($check!=null)?'B':'A', $img , $name],
                                        'category'  => 'time',
                                        'state'     => 'Free',
                                        'color'     => '#fff',
                                        'text01'    => $cate,
                                        'backgroundColor' => ($check!=null)?'gray':'green',
                                    );

                    //Checked Booking

                    $check  = date('Y-m-d',strtotime($s_time_01)).' '.date('H:i:00',strtotime($s_time_01));
                    // dd($s_time_02,$e_time_02);
                    $check  = BookSession::where('teacher_id',Auth::user()->id)
                                            ->where('start_time','>=',date('Y-m-d H:i:00'))
                                        //     ->where('end_time','>=',date('Y-m-d H:i:00',strtotime($e_time_02)))
                                        //     ->where('is_cancelled',0)
                                        // ->where( function($qry) use($s_time_02,$e_time_02){
                                        //     $qry->whereDate('start_time','>=',date('Y-m-d',strtotime($s_time_02)))
                                        //         ->whereTime('start_time','>=',date('H:i:00',strtotime($s_time_02)));
                                        // })
                                        // ->where( function($qry) use($s_time_02,$e_time_02){
                                        //     $qry->whereDate('end_time','>=',date('Y-m-d',strtotime($e_time_02)))
                                        //         ->whereTime('end_time','>=',date('H:i:00',strtotime($e_time_02)));
                                        // })

                                        ->where(function($qry) use($s_time_02,$e_time_02) {
                                            $qry->where(function($query) use($s_time_02,$e_time_02) {
                                                $query->where('start_time','>=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                        ->where('end_time','>=',date('Y-m-d H:i',strtotime($e_time_02)))
                                                        ->where('start_time','<=',date('Y-m-d H:i',strtotime($e_time_02)))
                                                        ->where('start_time','>=',date('Y-m-d H:i',strtotime($s_time_02)));
                                            })
                                            ->where(function($query) use($s_time_02,$e_time_02) {
                                                $query->where('start_time','<=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                        ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)))
                                                        ->where('end_time','>=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                        ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                            })
                                            ->orWhere(function($query) use($s_time_02,$e_time_02) {
                                                $query->where('start_time','>=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                        ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                            })
                                            ->orWhere(function($query) use($s_time_02,$e_time_02) {
                                                $query->where('start_time','<=',date('Y-m-d H:i',strtotime($s_time_02)))
                                                        ->where('end_time','>=',date('Y-m-d H:i',strtotime($e_time_02)));
                                            });
                                        })
                                        ->get();

                    date_default_timezone_set('UTC');

                    $name = $img = '';
                    if(count($check))
                    {
                        // dd($check);
                        foreach($check as $check12)
                        {
                            $check1 = DB::table('users')->where('id',$check12->student_id)->first();
                            $name   = $check1->name ?? '';
                            $img    = ($check1!=null && $check1!=null && $check1->avatar!=null)?asset('uploads/user/tutors/'.$check1->avatar):asset('assets/img/user/user.png');

                            $b_time_from   = new \DateTime($check12->start_time, new \DateTimeZone('UTC'));
                            $b_time_to     = new \DateTime($check12->end_time, new \DateTimeZone('UTC'));

                            $b_time_from->setTimezone(new \DateTimeZone($tz));
                            $b_time_to->setTimezone(new \DateTimeZone($tz));

                            $tf_time    = $b_time_from->format("Y-m-d H:i");
                            $tt_time    = $b_time_to->format("Y-m-d H:i");

                            $events[] = array(  'id'        =>'1',
                                        'calendarId'=> 'cal1',
                                        'title'     => ($check12!=null)?'Booked':'Available',
                                        'body'      => $cate,
                                        'start'     => str_replace(' ','T',$tf_time),
                                        'end'       => str_replace(' ','T',$tt_time),
                                        'location'  => 'Meeting Room A',
                                        'attendees' => [($check12!=null)?'B':'A', $img , $name],
                                        'category'  => 'time',
                                        'state'     => 'Free',
                                        'color'     => '#fff',
                                        'text01'    => $cate,
                                        'backgroundColor' => ($check12!=null)?'gray':'green',
                                    );
                                    // dd($events);
                        }

                    }


                }

            }

        }

        //Find Unavailability
        // date_default_timezone_set('UTC');
        // $unavailable = Unavailability::where('teacher_id',$user_id)->where('start_time','>=',date('Y-m-d H:i:00'))->get();
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
        //                     'attendees' => ['A', '' , ''],
        //                     'category'  => 'time',
        //                     'state'     => 'Free',
        //                     'color'     => '#fff',
        //                     'text01'    => '',
        //                     'backgroundColor' => 'red',
        //                 );
        // }

        // dd($events);
        // $events[] = array(  'id'        =>'1',
        //                                 'calendarId'=> 'cal1',
        //                                 'title'     => 'Booked',
        //                                 'body'      => '',
        //                                 'start'     => '2023-07-03T12:30:00',
        //                                 'end'       => '2023-07-03T13:00:00',
        //                                 'location'  => 'Meeting Room A',
        //                                 'attendees' => ['B','',''],
        //                                 'category'  => 'time',
        //                                 'state'     => 'Free',
        //                                 'color'     => '#fff',
        //                                 'text01'    => '',
        //                                 'backgroundColor' => 'red');
        $student_data = DB::table('users')->where('user_type',1)->where('status',1)->get();
        // dd($events);

        return view('front.teacher.calendar',compact('times1','times2','times3','times4','times5','times6','times7','events','tz','tz1','user_id','student_data'));
    }

    public function availabilityUpdate(Request $request)
    {
        $user_id = $request->user_id;
        $day['sun'] = [];
        $day['mon'] = [];
        $day['tue'] = [];
        $day['wed'] = [];
        $day['thu'] = [];
        $day['fri'] = [];
        $day['sat'] = [];

        $arr_set = [];
        $upt_dat = Carbon::now();

        $user    = User::where('id',$user_id)->first();
        $tz      = DB::table('time_zones')->where('id',$user->timezone ?? 195)->first();
        $tz      = $tz->timezone;
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // $tz1    = '1.00';

        if($request->has('f1') && $request->has('t1') && (count($request->get('f1'))==count($request->get('t1'))))
        {
            for($i=0;$i<=count($request->get('f1'))-1;$i++)
            {
                // $day['sun'][] = $request->get('f1')[$i].'-'.$request->get('t1')[$i];
                // if($request->get('f1')[$i] == '11:00 PM' && $request->get('t1')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f1')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t1')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f1')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t1')[$i];
                // }

                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");

                // echo $given->format("Y-m-d h:i:s A").'<br>';
                // $given->setTimezone(new \DateTimeZone("UTC"));
                // echo $given->format("Y-m-d h:i:s A").'<br>';
                // dd($request->get('f1')[$i].'-'.$request->get('t1')[$i]);
                // 'time_from'=>$request->get('f1')[$i],'time_to'=>$request->get('t1')[$i]

                $arr_set[]  = array('user_id'=>$user_id,'day'=>'sun','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f2') && $request->has('t2') && (count($request->get('f2'))==count($request->get('t2'))))
        {
            for($i=0;$i<=count($request->get('f2'))-1;$i++)
            {
                // $day['mon'][] = $request->get('f2')[$i].'-'.$request->get('t2')[$i];
                // if($request->get('f2')[$i] == '11:00 PM' && $request->get('t2')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f2')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t2')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f2')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t2')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'mon','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f3') && $request->has('t3') && (count($request->get('f3'))==count($request->get('t3'))))
        {
            for($i=0;$i<=count($request->get('f3'))-1;$i++)
            {
                // $day['tue'][] = $request->get('f3')[$i].'-'.$request->get('t3')[$i];
                // if($request->get('f3')[$i] == '11:00 PM' && $request->get('t3')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f3')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t3')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f3')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t3')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'tue','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f4') && $request->has('t4') && (count($request->get('f4'))==count($request->get('t4'))))
        {
            for($i=0;$i<=count($request->get('f4'))-1;$i++)
            {
                // $day['wed'][] = $request->get('f4')[$i].'-'.$request->get('t4')[$i];
                // if($request->get('f4')[$i] == '11:00 PM' && $request->get('t4')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f4')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t4')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f4')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t4')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'wed','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f5') && $request->has('t5') && (count($request->get('f5'))==count($request->get('t5'))))
        {
            for($i=0;$i<=count($request->get('f5'))-1;$i++)
            {
                // $day['thu'][] = $request->get('f5')[$i].'-'.$request->get('t5')[$i];
                // if($request->get('f5')[$i] == '11:00 PM' && $request->get('t5')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f5')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t5')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f5')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t5')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'thu','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f6') && $request->has('t6') && (count($request->get('f6'))==count($request->get('t6'))))
        {
            for($i=0;$i<=count($request->get('f6'))-1;$i++)
            {
                // $day['fri'][] = $request->get('f6')[$i].'-'.$request->get('t6')[$i];
                // if($request->get('f6')[$i] == '11:00 PM' && $request->get('t6')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f6')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t6')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f6')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t6')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'fri','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }
        if($request->has('f7') && $request->has('t7') && (count($request->get('f7'))==count($request->get('t7'))))
        {
            for($i=0;$i<=count($request->get('f7'))-1;$i++)
            {
                // $day['sat'][] = $request->get('f7')[$i].'-'.$request->get('t7')[$i];
                // if($request->get('f7')[$i] == '11:00 PM' && $request->get('t7')[$i] == '12:00 AM'){
                    // $updatedDateTimeString  = date('Y-m-d').' '.$request->get('f7')[$i];
                    // $dateTime = Carbon::parse($updatedDateTimeString)->addMinute();
                    // $time_from = $dateTime->format('Y-m-d h:i A');

                    // $updatedDateTimeStringt1  = date('Y-m-d').' '.$request->get('t7')[$i];
                    // $dateTime1 = Carbon::parse($updatedDateTimeStringt1)->addMinute();
                    // $time_to = $dateTime1->format('Y-m-d h:i A');
                // }else{
                    $time_from  = date('Y-m-d').' '.$request->get('f7')[$i];
                    $time_to    = date('Y-m-d').' '.$request->get('t7')[$i];
                // }
                $time_from_t1   = new \DateTime($time_from, new \DateTimeZone($tz));
                $time_to_t1     = new \DateTime($time_to, new \DateTimeZone($tz));

                $time_from_t1->setTimezone(new \DateTimeZone("UTC"));
                $time_to_t1->setTimezone(new \DateTimeZone("UTC"));

                $tf_time    = $time_from_t1->format("h:i A");
                $tt_time    = $time_to_t1->format("h:i A");
                $arr_set[] = array('user_id'=>$user_id,'day'=>'sat','time_from'=>$tf_time,'time_to'=>$tt_time,'updated_at'=>$upt_dat);
            }
        }

        // $update = Availability::updateOrCreate(['user_id'=>$user_id],['times'=>json_encode($day),'updated_at'=>Carbon::now()]);
        // dd($arr_set);
        DB::beginTransaction();

        try{
            $delete = Availability::where('user_id',$user_id)->delete();
            $update = Availability::insert($arr_set);

            DB::commit();
            return redirect()->back()->with('success','Availability has been updated successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error',$e->getMessage());
            return redirect()->back()->with('error','Oops something went wrong');
        }
    }
    public function st_time(Request $request)
    {
        $id = $request->std;
        $cred11 = Credit::where('user_id',$id)->sum('credit');
        if($cred11 > 0){
            $price = Credit::where('user_id',$id)->select('class_id')->get();
            $p1 = $price->toArray();
            $std = array_values($p1);
            $price = DB::table('pricings')->whereIn('id',$std)->get();
            $data = [];
            foreach($price as $pri){
                $pri1 = DB::table('price_masters')->where('id',$pri->price_master)->first();
                $pri2 = DB::table('credits')->where('class_id',$pri->id)->where('user_id',$id)->first();
                if($pri2->credit > 0)
                {
                    $data []= [
                        'id' => $pri->id,
                        'title' => $pri1->title,
                        'class' => $pri->totle_class,
                        'time' => $pri->time,
                    ];
                }
            }
            return response()->json([
             'st_id' => $id,
             'data' => $data,
             'success' =>true
         ]);
        }else{
            return response()->json([
                'success' =>false
            ]);
        }
    }
    public function cal_data(Request $request)
    {
        // date_default_timezone_set("Europe/Paris");
        // $tz_f   = 195;
        // $tz     = 'Asia/Kolkata';
        // $tz1    = '1.00';
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
        $error     = array();
        $temp     = 0;
        // dd($teacher_av);
        foreach ($teacher_av as $t_av) {

            $interval   = '60';
            
            $startTime  = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_from, new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone($tz));
            $endTime    = new \DateTime(date('Y-m-d') . ' ' . $t_av->time_to, new \DateTimeZone('UTC'));
            $endTime->setTimezone(new \DateTimeZone($tz));

            $st = Carbon::parse($startTime)->format('H:i');
            $end = Carbon::parse($endTime)->format('H:i');

            // dd($st);
            if($end == '00:00'){
                $interval   = '59';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-1 minutes");
                $endTime1 = $endTime1->format('h:i A');

                $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
                $endTime->setTimezone(new \DateTimeZone($tz));

            }

            // if($end == '00:05'){
            //     $interval   = '54';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-6 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }

            // if($end == '00:10'){
            //     $interval   = '49';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-11 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }

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
            // if($end == '00:35'){
            //     $interval   = '24';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-36 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:40'){
            //     $interval   = '19';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-41 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:45'){
            //     $interval   = '14';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-46 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:50'){
            //     $interval   = '9';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-51 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }
            // if($end == '00:55'){
            //     $interval   = '4';
            //     $endTime1 = Carbon::parse($t_av->time_to)->modify("-56 minutes");
            //     $endTime1 = $endTime1->format('h:i A');

            //     $endTime    = new \DateTime(date('Y-m-d') . ' ' . $endTime1, new \DateTimeZone('UTC'));
            //     $endTime->setTimezone(new \DateTimeZone($tz));

            // }else{
            //     $interval   = '60';
            // }

            // if($end >= '00:00'){
            //     $endTime = $endTime->modify('+1 day');
            // }

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
            // dd($interval);


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

                    $timeCom= strtotime(date('Y-m-d H:i',strtotime('+10 minutes',$s_date)));
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

                        $midnightStart = now()->startOfDay();
                        $midnightEnd = now()->startOfDay()->addDay();
                        $check  = BookSession::where('teacher_id', $teacher_id)
                                        ->where(function ($qry) use ($s_time_02, $e_time_02) {
                                                $qry->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                                    $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                                        ->where('end_time', '<', date('Y-m-d H:i', strtotime($e_time_02)))
                                                        ->where('end_time', '>', date('Y-m-d H:i', strtotime($s_time_02)));
                                                    // ->where('end_time','<=',date('Y-m-d H:i',strtotime($e_time_02)));
                                                })
                                                ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                                    $query->where('start_time', '>=', date('Y-m-d H:i', strtotime($s_time_02)))
                                                        ->where('end_time', '<=', date('Y-m-d H:i', strtotime($e_time_02)));
                                                })
                                                ->orWhere(function ($query) use ($s_time_02, $e_time_02) {
                                                    $query->where('start_time', '<=', date('Y-m-d H:i', strtotime($s_time_02)))
                                                        ->where('end_time', '>=', date('Y-m-d H:i', strtotime($e_time_02)));
                                                });
                                                
                                        })->where('is_cancelled', 0)
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
        // dd($error);

        $html = view('front.teacher.cal1', compact('events', 'tz', 'tz1','class_id','sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id'=>$class_id ,'sub_id'=>$sub_id]);
    }

    public function book_session(Request $req)
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
            $url = route('teacher.book.session.merithub', $insert_id);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }
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
                        "name" => $s_user->name ?? null,
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
                // dd($email2);
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

    public function cancleclass(Request $request)
    {
        $id = $request->active;
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            $data = [
                'is_cancelled' => 1,
                'cancelled_by' => $user_id,
            ];

            DB::table('book_sessions')->where('id', $id)->update($data);

            $book_session = BookSession::where('id', $id)->first();
            $teacher = DB::table('users')->where('id', $book_session->teacher_id)->first();
            $student = DB::table('users')->where('id', $book_session->student_id)->first();


            $email2 =
                [
                    'sender_email' => $student->email,
                    'inext_email' => env('MAIL_USERNAME'),
                    't_name' => $student->name,
                    's_name' => $teacher->name,
                    'title' => 'Class cancelled!',
                ];
                Mail::send('mail.student-cancle-class', $email2, function ($messages) use ($email2) {
                    $messages->to($email2['sender_email'])
                        ->from($email2['inext_email'], 'Knowmerit');
                    $messages->subject(" Cancellation Notice - Keep the Learning Spirit Alive!");
                });

            $email =
            [
                'sender_email' => $teacher->email,
                'inext_email' => env('MAIL_USERNAME'),
                't_name' => $student->name,
                's_name' => $teacher->name,
                'title' => 'Class cancelled!',
            ];

            Mail::send('mail.teacher-cancle', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                    ->from($email['inext_email'], 'Knowmerit');
                $messages->subject("Cancellation Notice - Keep the Learning Spirit Alive!");
            });
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
    public function dash(Request $request)
    {
        $id = $request->active;
        $category_id = Db::table('credits')->where('student_id',$id)->where('teacher_id',Auth::user()->id)->where('class_id',$request->class)->first();
        $category = Db::table('categories')->where('id',$category_id->class_id)->first();
        $video = Db::table('student_videos')->where('student_id',$id)->get();
        $homework = Db::table('student_documents')->where('d_type','homework')->where('student_id',$id)->get();
        $test = Db::table('student_mcqs')->where('student_id',$id)->get();
        $document = Db::table('student_documents')->where('d_type','document')->where('student_id',$id)->get();
        return view('front.teacher.inst-dashboard',compact('id','category','test','video','homework','document'));

    }
    public function vstore(Request $request)
    {

        DB::beginTransaction();
        try{

            if($request->file('video')){

                    $image = $request->file('video');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();

                    $destination_path = public_path('/uploads/s_video/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);

            }
            $teacher_id = Auth::user()->id;
            $data = [
                'teacher_id' => $teacher_id,
                'student_id' => $request->input('student_id'),
                'url' => $final_image_name,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('student_videos')->insert($data);

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
    public function dstore(Request $request)
    {

        DB::beginTransaction();
        try{
            if ($request->hasFile('file') && $request->file('file') != "") {
                $filePath = public_path('/uploads/s_documents/');
                $files = $request->file('file');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();

                }
            }
            foreach ($files as $file) {
                $image = $file;
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();
                $destination_path = public_path('/uploads/s_documents/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, 0777, true, true);
                }

                $teacher_id = Auth::user()->id;

                DB::table('student_documents')->insert([
                    'teacher_id' => $teacher_id,
                    'student_id' => $request->input('student_id'),
                    'document' => $final_image_name,
                    'd_type' =>$request->input('category'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $image->move($destination_path, $final_image_name);
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
    public function mcqlist(Request $request)
    {
        $id = $request->category;
        // dd($id);
        $mcq_title = Db::table('mcq_types')->where('sub_category',$id)->where('status',1)->get();
        if (count($mcq_title) > 0) {
            return response()->json([
                'success' => true,
                'value' => $mcq_title
            ]);
        } else
            return response()->json([
                'success' => false,
            ]);

        }
    public function mcqstore(Request $request)
    {
        DB::beginTransaction();
        try{
                $teacher_id = Auth::user()->id;
                DB::table('student_mcqs')->insert([
                    'teacher_id' => $teacher_id,
                    'student_id' => $request->input('student_id1'),
                    'category' => $request->input('category'),
                    'sub_category' => $request->input('sub_category1'),
                    'mcq_id' => $request->input('test_title'),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

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

    public function teacherEdit(Request $request)
{
    $tutor_id = Auth::user()->id;
        // dd($tutor_id);
    if($request->isMethod('get'))
    {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();

       // dd($parent_sub);
        $list_langauge =  DB::table('list')->get();
        $tutor  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        // dd($tutor);
        $p_code =DB::table('countries')->where('phonecode',$tutor->c_code)->first();
        $iso = $p_code->sortname;
        return view('front.teacher.profile' ,compact('tutor','list_langauge','parent_categories','iso'));
    }
        $tutor1  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        //  dd($tutor1);
        if (!$tutor1) {
            // Handle the case where no tutor with the given ID is found.
            return response()->json([
                'success' => false,
                'message' => 'Tutor not found'
            ]);
        }
        $rules = [
            'tutor_name' => 'required|regex:/^[A-Za-z ]+$/',
            'tutor_email' => 'required|email',
            'tutor_location' => 'required',
            'category' => 'required',
            // 'tutor_gender' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            'c_code' => 'required',
            'tutor_mobile' => 'required',
            'language' => 'required',
            'backgorund_experience' => 'required',
            'degree' => 'required',
            'university_name' => 'required',
            'degree_status' => 'required',
            'school_board' => 'required',
            'conduct_mode_class' => 'required',
            'teaching_experience' => 'required',
            // 'experience_year' => 'required',
            // 'classes_mode' => 'required',
            'charge_amount' => 'required',
            'describe_experience' => 'required'

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
        $tutor  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        // dd($tutor);
                  if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/tutors/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            } else {
                $final_image_name = $tutor->image;
            }

            if($request->input('all_state_subject') != null){
                $all_state_subject = implode(",", $request->input('all_state_subject'));
            }
            if($request->input('all_state_board') != null){
                $all_state_board = implode(",", $request->input('all_state_board'));
            }
            if($request->input('all_cbse_subject') != null){
                $all_cbse_subject = implode(",", $request->input('all_cbse_subject'));
            }
            if($request->input('all_icse_subject') != null){
                $all_icse_subject = implode(",", $request->input('all_icse_subject'));
            }
            if($request->input('all_inter_subject') != null){
                $all_inter_subject = implode(",", $request->input('all_inter_subject'));
            }
            if($request->input('all_nios_subject') != null){
                $all_nios_subject = implode(",", $request->input('all_nios_subject'));
            }
            if($request->input('all_igcse_subject') != null){
                $all_igcse_subject = implode(",", $request->input('all_igcse_subject'));
            }

                $data = [
                    'name' => $request->input('tutor_name'),
                    'email' => $request->input('tutor_email'),
                    'mobile' => $request->input('tutor_mobile'),
                    'location' => $request->input('tutor_location'),
                    'lng' => $request->input('lng'),
                    'lat' => $request->input('lat'),
                    'gender' => $request->input('tutor_gender'),
                    'parent_id' => implode(",", $request->input('category')),
                    'category' => implode(",", $request->input('category')),
                    'sub_category' => $request->has('sub_category') ? implode(",", $request->input('sub_category')) : '',
                    // 'image' => !empty($final_image_name) ? $final_image_name : NULL,
                    'status' => 1,
                    'c_code' => preg_replace('/[^0-9]/', '', strstr($request->c_code, '+')),
                    'language' =>implode(",", $request->input('language')),
                    'backgorund_experience' => $request->input('backgorund_experience'),
                    'degree' => $request->input('degree'),
                    'charge_amount' => $request->input('charge_amount'),
                    'university_name' => $request->input('university_name'),
                    'degree_status' => $request->input('degree_status'),
                    'school_board' =>implode(",", $request->input('school_board')),
                    'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                    'youtube_url' => $request->input('youtube_url'),
                    'teaching_experience' => $request->input('teaching_experience'),
                    'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                    'describe_experience' => $request->input('describe_experience'),
                    // 'classes_mode' => implode(",", $request->input('classes_mode')),
                    'all_state_subject' => $all_state_subject ?? null,
                    'state_board' => $all_state_board ?? null,
                    'cbse_subject' =>$all_cbse_subject ?? null,
                    'icse_subject' =>$all_icse_subject  ?? null,
                    'igcse_subject' => $all_igcse_subjec ?? null,
                    'international_subject' => $all_inter_subject ?? null,
                    'nios_subject' =>  $all_nios_subject ?? null,
                    'payment_status' => $request->input('payment_status'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];
            $data1 = [
                'first_name' => $request->input('tutor_name'),
                'name' => $request->input('tutor_name'),
                'phone' => $request->input('tutor_mobile'),
                'avatar'=>!empty($final_image_name) ? $final_image_name : NULL,
            ];
    // dd($data);


            DB::table('users')->where('id', $tutor1->user_id)->update($data1);
            DB::table('tutors')->where('user_id', $tutor_id)->update($data);

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

public function instituteEdit(Request $request)
{
    $tutor_id = Auth::user()->id;
        // dd($tutor_id);
    if($request->isMethod('get'))
    {
        $parent_categories = DB::table('categories')->where('status', '<>', 2)->where('parent', 0)->get();
        $list_langauge =  DB::table('list')->get();
        $tutor  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        // dd($tutor);
        $p_code =DB::table('countries')->where('phonecode',$tutor->c_code)->first();
        $iso = $p_code->sortname;
        return view('front.teacher.profile-institute' ,compact('tutor','list_langauge','parent_categories','iso'));
    }
        $tutor1  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        //  dd($tutor1);
        if (!$tutor1) {
            // Handle the case where no tutor with the given ID is found.
            return response()->json([
                'success' => false,
                'message' => 'Tutor not found'
            ]);
        }
        $rules = [
            'tutor_name' => 'required|regex:/^[A-Za-z ]+$/',
            'tutor_email' => 'required|email',
            'tutor_location' => 'required',
            'category' => 'required',
            'institute_name' => 'required',
            // 'tutor_travel' => 'required|numeric|max:25',
            'c_code' => 'required',
            'tutor_mobile' => 'required',
            'language' => 'required',
            'backgorund_experience' => 'required',
            'degree' => 'required',
            'university_name' => 'required',
            'degree_status' => 'required',
            'school_board' => 'required',
            'conduct_mode_class' => 'required',
            'teaching_experience' => 'required',
            // 'experience_year' => 'required',
            // 'classes_mode' => 'required',
            'charge_amount' => 'required',
            'describe_experience' => 'required'

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
        $tutor  = DB::table('tutors')->where('user_id',$tutor_id)->first();
        // dd($tutor);
                  if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/tutors/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            } else {
                $final_image_name = $tutor->image;
            }

            if($request->input('all_state_subject') != null){
                $all_state_subject = implode(",", $request->input('all_state_subject'));
            }
            if($request->input('all_state_board') != null){
                $all_state_board = implode(",", $request->input('all_state_board'));
            }
            if($request->input('all_cbse_subject') != null){
                $all_cbse_subject = implode(",", $request->input('all_cbse_subject'));
            }
            if($request->input('all_icse_subject') != null){
                $all_icse_subject = implode(",", $request->input('all_icse_subject'));
            }
            if($request->input('all_inter_subject') != null){
                $all_inter_subject = implode(",", $request->input('all_inter_subject'));
            }
            if($request->input('all_nios_subject') != null){
                $all_nios_subject = implode(",", $request->input('all_nios_subject'));
            }
            if($request->input('all_igcse_subject') != null){
                $all_igcse_subject = implode(",", $request->input('all_igcse_subject'));
            }

                $data = [
                    'name' => $request->input('tutor_name'),
                    'email' => $request->input('tutor_email'),
                    'mobile' => $request->input('tutor_mobile'),
                    'location' => $request->input('tutor_location'),
                    'lng' => $request->input('lng'),
                    'lat' => $request->input('lat'),
                    'institute_name' => $request->input('institute_name'),
                    'parent_id' => implode(",", $request->input('category')),
                    'category' => implode(",", $request->input('category')),
                       'sub_category' => $request->has('sub_category') ? implode(",", $request->input('sub_category')) : '',
                    // 'image' => !empty($final_image_name) ? $final_image_name : NULL,
                    'status' => 1,
                    'c_code' => preg_replace('/[^0-9]/', '', strstr($request->c_code, '+')),
                    'language' =>implode(",", $request->input('language')),
                    'backgorund_experience' => $request->input('backgorund_experience'),
                    'degree' => $request->input('degree'),
                    'charge_amount' => $request->input('charge_amount'),
                    'university_name' => $request->input('university_name'),
                    'degree_status' => $request->input('degree_status'),
                    'school_board' =>implode(",", $request->input('school_board')),
                    'conduct_mode_class' => implode(",", $request->input('conduct_mode_class')),
                    'youtube_url' => $request->input('youtube_url'),
                    'teaching_experience' => $request->input('teaching_experience'),
                    // 'experience_year' => $request->input('experience_year'),
                    'experience_year' => ($request->input('teaching_experience') == 'No') ? null : $request->input('experience_year'),
                    'describe_experience' => $request->input('describe_experience'),
                    // 'classes_mode' => implode(",", $request->input('classes_mode')),
                    'all_state_subject' => $all_state_subject ?? null,
                    'state_board' => $all_state_board ?? null,
                    'cbse_subject' =>$all_cbse_subject ?? null,
                    'icse_subject' =>$all_icse_subject  ?? null,
                    'igcse_subject' => $all_igcse_subjec ?? null,
                    'international_subject' => $all_inter_subject ?? null,
                    'nios_subject' =>  $all_nios_subject ?? null,
                    'payment_status' => $request->input('payment_status'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];
            $data1 = [
                'first_name' => $request->input('tutor_name'),
                'name' => $request->input('tutor_name'),
                'phone' => $request->input('tutor_mobile'),
                'avatar'=>!empty($final_image_name) ? $final_image_name : NULL,
            ];
    // dd($data);


            DB::table('users')->where('id', $tutor1->user_id)->update($data1);
            DB::table('tutors')->where('user_id', $tutor_id)->update($data);

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
            DB::table('tutors')->where('user_id',Auth::user()->id)->delete();

            $message = 'Account deactivated successfully.';
        } else {
            DB::table('users')->where('id',Auth::user()->id)->update(['status' => 1]);
            DB::table('tutors')->where('user_id',Auth::user()->id)->update(['status' => 1]);

            $message = 'Account activated successfully.';
        }

        return response()->json(['success' => true, 'message' => $message]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while processing your request.']);
    }
}

//////////////////student profile img///////////////
public function teacher_profile_edit_img(Request $request)
{
    $id = Auth::user()->id;
    $data = DB::table('users')->where('id', $id)->first();
    $data2 = DB::table('tutors')->where('user_id', $id)->first();
    return view('front.teacher.profile', compact('data','data2'));
}

public function teacher_profile_update_img(Request $request)
    {
        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $date = date('YmdHis');
            $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            $random_no = substr($no, 0, 2);
            $final_image_name = $date . $random_no . '.' . $avatar->getClientOriginalExtension();

            $destination_path = public_path('/uploads/tutors/');
            if (!File::exists($destination_path)) {
                File::makeDirectory($destination_path, $mode = 0777, true, true);
            }
            $avatar->move($destination_path, $final_image_name);
        }
        $id = Auth::user()->id;
        $con =  DB::table('users')->where('id', $id)->update([
            'avatar' => !empty($final_image_name) ? $final_image_name : NULL,
        ]);
        DB::commit();
        return response()->json([
            'success' => true
        ]);
    }
    ///////////////////////complete edit section/////
    public function classmeeting(Request $request)
    {
        $id = base64_decode($request->id);
        return view('front.teacher.meeting-jisti',compact('id'));
    }
    public function dash1(Request $request)
    {
        $id = $request->active;
        $data1 = DB::table('credits')->where('student_id', $id)->where('teacher_id',Auth::user()->id)->first();
        return view('front.teacher.student1',compact('data1'));

    }
    public function mathpad(Request $request)
    {
        return view('front.teacher.math');
        // return json_encode(['status' => true, 'html' => $html]);
    }

    public function r_cal_data(Request $request)
    {
        $id = $request->id;
        $book_session = BookSession::where('id',$id)->first();
        $t_timezone = DB::table('users')->where('id',$book_session->teacher_id)->first();
        $timezone = DB::table('time_zones')->where('id',$t_timezone->timezone)->first();
        $tz = $timezone->timezone ?? 'Asia/Kolkata';
        $tz1 = $timezone->raw_offset ?? '1.00';
        date_default_timezone_set($tz);

        $student_id = $book_session->student_id;
        $class_id   = $book_session->class_id;
        $sub_id   = $book_session->sub_id;
        $teacher_id = $book_session->teacher_id;
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


            $st = Carbon::parse($startTime)->format('H:i');
            $end = Carbon::parse($endTime)->format('H:i');

            if($end == '00:00'){
                $interval   = '59';
                $endTime1 = Carbon::parse($t_av->time_to)->modify("-1 minutes");;
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

                    $timeCom= strtotime(date('Y-m-d H:i',strtotime('+10 minutes',$s_date)));
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

        $html = view('front.teacher.cal3', compact('events', 'tz', 'tz1','class_id','sub_id'))->render();
        return json_encode(['status' => true, 'html' => $html, 'class_id'=>$class_id ,'sub_id'=>$sub_id,'student_id'=>$student_id,'session_id'=>$id]);
    }

    public function r_book_session(Request $req)
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

        BookSession::where('id',$req->session_id)->update($insert_arr);
        if ($req->session_id != null) {
            $url = route('teacher.r_book.session.merithub', $req->session_id);
            return json_encode(['status' => true, 'msg' => 'Booking Successfull', 'url' => $url]);
            // return json_encode(['status' => true, 'msg' => 'Booking Successfull']);
        } else {
            return json_encode(['status' => false, 'msg' => 'Oops something went wrong', 'url' => '']);
        }
    }
    public function r_merithub_create_class(Request $request)
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
                    'title' => 'Student Class Booking Email',
                    'class_time' => $times,
                    'class_name' => $class_details->name,
                ];

                Mail::send('mail.student-reschedule', $email, function ($messages) use ($email) {
                    $messages->to($email['sender_email'])
                        ->from($email['inext_email'], 'Know-merit');
                    $messages->subject("Successful Reschedule - Get Ready for a New Learning Adventure!");
                });

            // Email for Teacher
            $email2 =
                [
                    'sender_email' => $t_user->email,
                    'inext_email' => env('MAIL_USERNAME'),
                    't_name' => $t_user->name,
                    's_name' => $s_user->name,
                    'title' => 'Successfully Registered!',
                    'class_time' => $times2,
                    'class_name' => $class_details->name,

                ];

                Mail::send('mail.teacher-reschedule', $email2, function ($messages) use ($email2) {
                    $messages->to($email2['sender_email'])
                        ->from($email2['inext_email'], 'Know-merit');
                    $messages->subject("Successful Reschedule - Get Ready for a New Learning Adventure!");
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
    public function enqdata(Request $request)
    {
        $data = [
            'status' => 0,
        ];
        DB::table('bookclassenquiries')->where('teacher_id',Auth::user()->id)->update($data);
        return response()->json([
            'success' =>true
        ]);
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
