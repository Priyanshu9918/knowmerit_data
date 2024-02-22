<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class ContactMasterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $role = DB::table('contact_masters')
                ->where('status', '<>', 2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($role)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->editColumn('description', function ($row) {
                    return '<span class="badge badge-soft-danger my-1 me-2">' . $row->description . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $action_1 = '';
                    if ($row->status == 0) {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                        </a>';
                        //dd($action_1);
                    } else {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                            <span class="icon">
                                            <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                        </a>';
                    }

                    $edit_url = url('/admin/contact_masters/edit', ['id' => base64_encode($row->id)]);

                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                    data-bs-toggle="tooltip" data-placement="top" title=""
                    data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                    <i class="fas fa-trash text-danger"></i>
                </a>';

                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                    ' . $action_1 . '
                                        ' . $action_2 . '
                                        ' . $action_3 . '
                                    </div>
                                </div>';
                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action', 'one_image', 'description'])->make(true);

            return $datatables;
        }
        return view('admin.contact_masters.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $contact_masters = DB::table('contact_masters')->where('status', 1)->get();
            return view('admin.contact_masters.create', compact('contact_masters'));
        }

        $rules = [
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
        try {

            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            // dd($data);
            DB::table('contact_masters')->insert($data);

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
    public function edit(Request $request)
    {
        $contact_masters_id = base64_decode($request->id);

        if ($request->isMethod('get')) {

            $contact_masters  = DB::table('contact_masters')->where('id', $contact_masters_id)->first();
            return view('admin.contact_masters.edit', compact('contact_masters'));
        }

        $rules = [
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
        try {
            $contact_masters  = DB::table('contact_masters')->where('id', $contact_masters_id)->first();
            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('contact_masters')->where('id', $contact_masters_id)->update($data);

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
