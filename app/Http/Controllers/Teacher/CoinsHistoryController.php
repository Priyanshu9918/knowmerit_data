<?php

namespace App\Http\Controllers\teacher;

use App\Models\CoinsHistory;
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
use App\Models\User;
// use App\Models\LanguageList;

class CoinsHistoryController extends Controller
{

    public function razorPaySuccess5(Request $request) {
        // Get the authenticated user's ID
        $tutor_id = Auth::user()->id;
        $tutor = DB::table('tutors')->where('user_id', $tutor_id)->first();
        // dd($tutor);
        if ($tutor) {
            $bill_details = new CoinsHistory;
            $bill_details->tutor_id = $tutor_id;
            $bill_details->first_name = $tutor->name ?? '';
            $bill_details->email = $tutor->email ?? '';
            $bill_details->mobile = $tutor->mobile ?? '';
            $bill_details->amount = $request->amount ?? '';
            $bill_details->title = $request->title ?? '';
            $bill_details->payment_status = 1;
            $bill_details->r_payment_id = $request->payment_id ?? '';
// dd($bill_details);
            $bill_details->save();

        } else {

            $arr = ['msg' => 'Tutor not found', 'status' => false];
        }

        return redirect('teacher/teacher-coins-history');

        // return response()->json($arr);
    }




}
