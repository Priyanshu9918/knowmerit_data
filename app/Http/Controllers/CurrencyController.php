<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Book_a_class;

class CurrencyController extends Controller
{
    public function currency(Request $request)
    {
        $ip = '49.35.41.195';
        // $ip = request()->ip();
        $data = \Location::get($ip); 
        $c_name = $data->countryName;
        $data1 = DB::table('currency')->where('country',$c_name)->first();
        dd($data1);
        return view('details',compact('data'));
    }
}
