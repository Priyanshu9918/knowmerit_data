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

class ProductsController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $games = DB::table('products')->where('status','<>',2)->orderBy('id','DESC')->get();
            $datatables = Datatables::of($games)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y',strtotime($row->created_at));
            })
            ->addColumn('action', function($row) {
                $action_1 = '';
                if($row->status==0)
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    //dd($action_1);
                }
                else
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                }

                $edit_url = url('/admin/products/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                data-bs-toggle="tooltip" data-placement="top" title=""
                data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                <i class="fas fa-trash text-danger"></i>
            </a>';

                $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                    '.$action_2.'
                                    '.$action_3.'
                                </div>
                            </div>';
                return $action;
            });

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.product.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            $role  = DB::table('roles')->where('status','1')->get();

            return view('admin.product.create',compact('role'));
        }

        $rules = [
            'title' => 'required',
            'price' => 'required',
            'd_price' => 'required',
            'gross_weight' => 'required',
            'net_weight' => 'required',
            'no_pcs' => 'required',
            'about' => 'required',
            'instruction' => 'required',
            'image' => 'required',
            'customize' => 'required',
            'customize_title' => 'required',
            'customize_price' => 'required',
            'customize_pack' => 'required',
            'customize_image' => 'required_if:customize,on',
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

            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/product/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            }

            $data = [
                'title' => $request->input('title'),
                'price' => $request->input('price'),
                'd_price' => $request->input('d_price'),
                'gross_weight' => $request->input('gross_weight'),
                'net_weight' => $request->input('net_weight'),
                'no_pcs' => $request->input('no_pcs'),
                'about' => $request->input('about'),
                'instruction' => $request->input('instruction'),
                'image' => $final_image_name,
                'customize' => $request->input('customize'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $p_id = DB::table('products')->insertGetId($data);

            if($request->input('customize') == 'on') {
                $customize_titles = $request->customize_title;
                $customize_images = $request->file('customize_image');
                $customize_prices = $request->customize_price;
                $customize_packs = $request->customize_pack;
                
                // Initialize an array to hold all customization data
                $customizationData = [];
                
                for ($i = 0; $i < count($customize_images); $i++) {
                    $final_image_name = null;
                    
                    if ($customize_images[$i]) {
                        $image = $customize_images[$i];
                        $date = date('YmdHis');
                        $random_no = str_shuffle('1234567890');
                        $random_no = substr($random_no, 0, 2);
                        $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();
                        
                        $destination_path = public_path('/uploads/c_product/');
                        
                        if (!File::exists($destination_path)) {
                            File::makeDirectory($destination_path, $mode = 0777, true, true);
                        }
                        
                        $image->move($destination_path, $final_image_name);
                    }
                    
                    // Add each customization entry to the $customizationData array
                    $customizationData[] = [
                        'product_id' => $p_id,
                        'customize_title' => $customize_titles[$i],
                        'customize_price' => $customize_prices[$i],
                        'customize_pack' => $customize_packs[$i],
                        'customize_image' => $final_image_name,
                    ];
                }
                
                // Insert all customization data at once using insert method
                DB::table('customize_products')->insert($customizationData);
            }
            
                // $data1 = [
                //     'product_id' => $p_id,
                //     'customize_title' => implode(',',$customize_titles),
                //     'customize_price' => implode(',',$customize_prices), // Corrected from $customize_titles to $customize_prices
                //     'customize_pack' => implode(',',$customize_packs), // Corrected from $customize_titles to $customize_packs
                //     'customize_image' => implode(',',$images), // Corrected from $image to $images
                // ];

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

    public function edit(Request $request)
    {
        $user_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $product  = DB::table('products')->where('id',$user_id)->first();
            $c_product  = DB::table('customize_products')->where('product_id',$user_id)->get();

            return view('admin.product.edit',compact('product','c_product'));
        }
        $rules = [
            'title' => 'required',
            'price' => 'required',
            'd_price' => 'required',
            'gross_weight' => 'required',
            'net_weight' => 'required',
            'no_pcs' => 'required',
            'about' => 'required',
            'instruction' => 'required',
            'customize' => 'required',
            'customize_title' => 'required',
            'customize_price' => 'required',
            'customize_pack' => 'required',
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

            $imagesss = DB::table('products')->where('id',$user_id)->first();
            if ($request->file('image')) {

                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

                $destination_path = public_path('/uploads/product/');
                if (!File::exists($destination_path)) {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path, $final_image_name);
            }else{
                $final_image_name = $imagesss->image;
            }

            $data = [
                'title' => $request->input('title'),
                'price' => $request->input('price'),
                'd_price' => $request->input('d_price'),
                'gross_weight' => $request->input('gross_weight'),
                'net_weight' => $request->input('net_weight'),
                'no_pcs' => $request->input('no_pcs'),
                'about' => $request->input('about'),
                'instruction' => $request->input('instruction'),
                'image' => $final_image_name,
                'customize' => $request->input('customize'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('products')->where('id',$user_id)->update($data);

            $c_imagesss = DB::table('products')->where('id',$user_id)->first();
            $img = explode(',',$c_imagesss->image);
            
            if($request->input('customize') == 'on') {
                $customize_titles = $request->customize_title;
                $customize_images = $request->file('customize_image');
                $customize_prices = $request->customize_price;
                $customize_packs = $request->customize_pack;
                
                // Initialize an array to hold all customization data
                $customizationData = [];
                
                for ($i = 0; $i < count($customize_images); $i++) {
                    $final_image_name = null;
                    
                    if ($customize_images[$i]) {
                        $image = $customize_images[$i];
                        $date = date('YmdHis');
                        $random_no = str_shuffle('1234567890');
                        $random_no = substr($random_no, 0, 2);
                        $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();
                        
                        $destination_path = public_path('/uploads/c_product/');
                        
                        if (!File::exists($destination_path)) {
                            File::makeDirectory($destination_path, $mode = 0777, true, true);
                        }
                        
                        $image->move($destination_path, $final_image_name);
                    }
                    
                    // Add each customization entry to the $customizationData array
                    $customizationData[] = [
                        'product_id' => $p_id,
                        'customize_title' => $customize_titles[$i],
                        'customize_price' => $customize_prices[$i],
                        'customize_pack' => $customize_packs[$i],
                        'customize_image' => $final_image_name,
                    ];
                }
                
                // Insert all customization data at once using insert method
                DB::table('customize_products')->insert($customizationData);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }
}
