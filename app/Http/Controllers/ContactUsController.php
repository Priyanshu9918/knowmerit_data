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

class ContactUsController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $games = DB::table('enquiries')->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($games)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })
            ->addColumn('action', function($row) {

                $action_1 = '<a href="javascript:void(0)" id="View" data-id="'.$row->id.'"><i class="fas fa-eye text-info"></i></a>';

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                </div>
                            </div>';
                return $action;
            });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.enquiry.index');
    }

    public function create(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'description' => 'required',
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

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'description' => $request->input('description'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('enquiries')->insert($data);

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

    public function view(Request $request)
    {
        $enquiry = DB::table('enquiries')->where('id',$request->id)->first();

        return response()->json(array('status'=>true,'fdata'=>$enquiry));
    }

}
