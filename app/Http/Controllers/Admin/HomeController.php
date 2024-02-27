<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\BookSession;
use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\WriteReview;
class HomeController extends Controller
{
    public function index(){
    // $users = User::count();
    // $Activeusers = User::where('status',1)->count();
    // $Inactiveusers = User::where('status',0)->count();
    // $teacher = User::where('user_type',2)->count();
    // $ActiveTeacher = User::where('user_type',2)->where('status',1)->count();
    // $InactiveTeacher = User::where('user_type',2)->where('status',0)->count();
    // $student = User::where('user_type',3)->count();
    // $Activestudent = User::where('user_type',3)->where('status',1)->count();
    // $Inactivestudent = User::where('user_type',3)->where('status',0)->count();
    // $category = Category::where('parent',0)->where('status',1)->count();
    // $Subcategory = Category::where('parent','!=',0)->where('status',1)->count();
    // $BookSession = BookSession::where('is_cancelled',0)->count();
    // $BookSessionCancel = BookSession::where('is_cancelled',1)->count();
    // $blog = Blog::where('status',1)->count();
    // $contact = Enquiry::where('status',1)->count();
    // $feedback = WriteReview::count();
    return view('admin.dashboard');

    }
}
