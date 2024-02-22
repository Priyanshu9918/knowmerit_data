<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Landingdata;
use Mail;
class LandingController extends Controller
{
    public function maths(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.maths');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' =>'Maths',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.email_for_user', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.email_for_admin', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry");
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

    public function mathstwo(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.maths');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' => 'Maths',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.email_for_user', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.email_for_admin', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry");
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
    ///////////science////////////
    public function science(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.science');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' =>'Science',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.science_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_science_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry");
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

    public function sciencetwo(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.maths');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' => 'Science',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.science_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_science_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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
    //////////////coding///////////
    public function coding(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.coding');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' =>'Coding',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.coding_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_coding_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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

    public function codingtwo(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.coding');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' => 'Coding',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.coding_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_coding_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiryd.");
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

    ////////////English////////////////
    public function english(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.english');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' =>'English',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.english_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_english_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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

    public function englishtwo(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.english');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' => 'English',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.english_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_english_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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
    ////////////financial-literacy/////////////
    public function financial(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.financial');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' =>'Financial-literacy',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.financial_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_financial_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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

    public function financialtwo(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('landing.financial');
        }

        $rules = [
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'subject' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $datauser = [
                'name' => $request->input('first_name'),
                'first_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject_type' => 'Financial-literacy',
                'gender' => $request->input('gender'),
                'subject' => $request->input('subject'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('landingdatas')->insertGetId($datauser);
            $email =
            [
                'sender_email' => $request->input('email'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
                'sender_name' => $request->input('first_name'),
            ];
            Mail::send('mail.financial_email', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                         ->from($email['inext_email'], 'Know-merit');
                $messages->subject("Your registration request has been successfully received.");
            });

            $email1 =
            [
                'sender_name' => $request->input('first_name'),
                'sender_email' => $request->input('email'),
                'gender' =>  $request->input('gender'),
                'mobile' =>  $request->input('phone'),
                'subject' => $request->input('subject'),
                'inext_email' => env('MAIL_USERNAME'),
                'title' => 'Successfully Registered!',
            ];
            Mail::send('mail.admin_financial_email', $email1, function ($messages) use ($email1) {
                $messages->to('admin@knowmerit.com')
                         ->from($email1['inext_email'], 'Know-merit')
                         ->bcc(['shivam@techsaga.net','vishaltechsaga@gmail.com']); // Add BCC recipients here
                $messages->subject("Generation of New Inquiry.");
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












}
