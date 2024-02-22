<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;

class CommonController extends Controller
{
    public function fetch(Request $request)
    {
            $slug = $request->slug;
            if($slug == 'need-help' ){
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.need-help',compact('data'));
            }
            elseif($slug == 'our-commitment'){
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.our-commitment',compact('data'));
            }
            elseif($slug == 'terms-and-conditions'){
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.terms-and-conditions',compact('data'));
            }
            elseif($slug == 'privacy-policy'){
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.privacy-policy',compact('data'));
            }
            elseif($slug == 'refund-policy'){
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.refund-policy',compact('data'));
            }
            else
            {
                $data = DB::table('manage_pages')->where('slug',$slug)->first();

                return view('front.who-are-we',compact('data'));
            }

    }
}
