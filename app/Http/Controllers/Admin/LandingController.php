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
use App\Models\Landingdata;

class LandingController extends Controller
{
    public function index(Request $request)

    {
        if ($request->ajax()) {

            $games = DB::table('landingdatas')->where('status','<>',2)->orderBy('id','DESC')
           ->get();
            $datatables = Datatables::of($games)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })

                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
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


                    // $edit_url = url('/admin/landingdatas/edit', ['id' => base64_encode($row->id)]);
                    // $view_url = url('/admin/landingdatas/assign_teacher/view',['id'=>base64_encode($row->id)]);
                    // $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    // $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                    // data-bs-toggle="tooltip" data-placement="top" title=""
                    // data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                    // <i class="fas fa-trash text-danger"></i>
                    // </a>';
                        // $action_4 = '<a href="' . $view_url . '" class="btn btn-sm btn-clean btn-icon" title="Teacher Assign"><i class="fas fa-user text-info"></i></a>';


                           $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                ' . $action_1 . '
                                </div>
                            </div>';
                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.landingdatas.index');
    }
   }
