<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Validation\Rule;

class ChangePassController extends Controller
{

    public function changePassword()
    {
       return view('front.student.change-password');
    }
    public function updatePassword(Request $request)
    {
            # Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with("status", "Password changed successfully!");
    }
}
