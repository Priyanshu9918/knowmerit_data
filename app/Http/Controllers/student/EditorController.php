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

class EditorController extends Controller
{
    public function Editor() {
        return view('front.student.code-editor');
    }
    
}
