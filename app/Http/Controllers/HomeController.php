<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search_teacher(Request $request)
    {
        $query = $request->get('data');
        $tutors = DB::table('tutors')->where('name', 'LIKE', '%'. $query. '%')->get();
        return view('front.search_teacher',compact('tutors'));
    }
    public function search_teacher_lan(Request $request)
    {
        $query = $request->get('data');
        $tutors = DB::table('tutors')->where('language', 'LIKE', '%'. $query. '%')->get();
        return view('front.search_teacher_lan',compact('tutors'));
    }

    public function search_teacher_cat(Request $request)
    {
        $query = $request->get('data');
        $tutors = DB::table('tutors')
        ->join('categories', 'tutors.parent_id', '=', 'categories.id')
        ->where('categories.name','LIKE', '%'. $query. '%')->get();
        return view('front.search_teacher_cat',compact('tutors'));
    }

    public function filter_category(Request $request)
    {
        if(empty($request->select_specialist))
        {
            $tutor = DB::table('tutors');
        }
        else
        {
        $tutor = DB::table('tutors');
        if($request->select_specialist!=='')
        {
        $tutor->whereIn('parent_id',$request->select_specialist);
        }
        }

        $tutors1 = $tutor->get();
        $filter_cat = $request->select_specialist;
        return view('front.teacher.trainer_list_cat',compact('tutors1','filter_cat'));
    }

    public function instructor_profile(Request $request)
    {
            $id = $request->id;
            $profile = DB::table('tutors')->where('user_id',$id)->first();
            $userp = DB::table('users')->where('id',$profile->user_id)->first();
            return view('front.instructor_profile',compact('profile','userp'));
    }
}
