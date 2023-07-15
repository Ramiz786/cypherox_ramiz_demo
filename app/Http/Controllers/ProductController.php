<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use DataTables;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if($this->role == 'Admin'){
                return $next($request);
            }else{
                return redirect('/home');
            }
        });

    }
    public function index()
    {
        $product = ProductModel::paginate(10);
        return view('product.index', ['product' => $product]);
    }


    //ajax form add edit
    public function addForm(Request $request)
    {
        $categories = CategoryModel::orderBy('Name', 'ASC')->get();
        $returnHTML = view('product.add_form', ['categories' => $categories])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
        // return view('subject.index');

    }

    public function editForm(ProductModel $product)
    {
        $categories = CategoryModel::orderBy('Name', 'ASC')->get();
        $returnHTML = view('product.edit_form', ['categories' => $categories, 'product' => $product])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
        // return view('subject.index');

    }


    /**
     * Create User 
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function create()
    {

        return view('product.add');
    }

    /**
     * Store User
     * @param Request $request
     * @return View Users
     * @author Shani Singh
     */
    public function store(Request $request)
    {
        // Validations
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:tbl_product,Name',
            'Image' => 'required',
            'ProductDescription' => 'required',
            'product_price' => 'required',
            'Category' => 'required',
            'Image.*' => 'mimes:jpeg,jpg,png,gif|max:700|dimensions:max_width=1040,max_height=1040'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            if ($request->hasFile('Image')) {

                \Storage::disk('uploads')->put("/product/" . $request->Image->hashName(), file_get_contents($request->Image->getRealPath()));
                $user = ProductModel::create([
                    'Name'    => $request->product_name,
                    'Category' => ($request->Category) ? $request->Category : 0,
                    'Price' => ($request->product_price) ? $request->product_price : 0,
                    'Image'    =>  $request->Image->hashName(),
                    'Description'    =>  $request->ProductDescription,
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Product Added Successfully.'
            ]);
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     * @author Shani Singh
     */
    public function edit(ProductModel $product)
    {
        return view('product.edit')->with([
            'medium'  => $product
        ]);
    }

    /**
     * Update ProductModel
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, ProductModel $product)
    {
        // Validations

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:tbl_product,Name,' . $product->id . ',id',
            'ProductDescription' => 'required',
            'product_price' => 'required',
            'Category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            if ($request->hasFile('Image')) {

                \Storage::disk('uploads')->put("/product/" . $request->Image->hashName(), file_get_contents($request->Image->getRealPath()));
                $product_update = ProductModel::whereId($product->id)->update([
                    'Name'    => $request->product_name,
                    'Category' => ($request->Category) ? $request->Category : 0,
                    'Price' => ($request->product_price) ? $request->product_price : 0,
                    'Image'    =>  $request->Image->hashName(),
                    'Description'    =>  $request->ProductDescription,
                ]);
            }else{
                $product_update = ProductModel::whereId($product->id)->update([
                    'Name'    => $request->product_name,
                    'Category' => ($request->Category) ? $request->Category : 0,
                    'Price' => ($request->product_price) ? $request->product_price : 0,
                    'Description'    =>  $request->ProductDescription,
                ]);
            }
           
            return response()->json([
                'status' => 200,
                'message' => 'Product Updated Successfully.'
            ]);
        }
    }

    /**
     * Delete User
     * @param User $user
     * @return Index Users
     * @author Shani Singh
     */

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            // Delete User
            ProductModel::whereId($request->id)->delete();

            DB::commit();
            toastr()->success('Inquiry Deleted Successfully');
            return redirect()->route('inquiry.index')->with('success', 'Inquiry Deleted Successfully!.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'row_id' => 'required|array',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $row_ids = $request->row_id;
            DB::beginTransaction();
            try {
                // Delete User
                foreach ($row_ids as $single_row) {
                    ProductModel::whereId($single_row)->delete();
                }

                DB::commit();
                // toastr()->success('ProductModel Deleted Successfully');
                // return redirect()->route('product.index')->with('success', 'ProductModel Deleted Successfully!.');
                return response()->json([
                    'status' => 200,
                    'message' => 'ProductModel Deleted Successfully.'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                // return redirect()->back()->with('error', $th->getMessage());
                return response()->json([
                    'status' => 400,
                    'error' =>  $th->getMessage()
                ]);
            }
        }
    }

    public function getDatatable(Request $request)
    {

        if ($request->ajax()) {

            $row_ids = $request->row_ids;

            $temp_row_id = '';
            $temp_row_id_array =  [];
            if ($row_ids != "") {
                $row_idss = explode(",", $row_ids);
                for ($i = 0; $i < count($row_idss); $i++) {
                    $temp_row_id_array[] = $row_idss[$i];
                }
                if (!empty($temp_row_id_array)) {
                    $temp_row_id = implode(",", $temp_row_id_array);
                }
            }

            // if($start_date && $end_date){

            // $start_date = date('Y-m-d', strtotime($start_date));
            // $end_date = date('Y-m-d', strtotime($end_date));

            // $postsQuery->whereRaw("date(posts.created_at) >= '" . $start_date . "' AND date(posts.created_at) <= '" . $end_date . "'");
            // }
            $this->temp_row_id = $temp_row_id;
            $data = ProductModel::select(ProductModel::raw('tbl_product.*,category.Name as CategoryName,CONCAT("' . url('/uploads/product') . '","/",tbl_product.Image) as ProductImage'))->leftJoin('tbl_category as category', 'tbl_product.Category', '=', 'category.id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('ProductImage', function ($row) {
                    if ($row->ProductImage == '') {

                        return '<img src="' . url('/public/images') . '/person-icon.png" height="100" width="100">';
                    } else {
                        return '<img src="' . $row->ProductImage . '" height="100" width="100">';
                    }
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javasctipt:;" data-method="' . route('product.product-edit-form', ['product' => $row->id]) . '" class="btn btn-primary m-2 open_my_form_form"> <i class="fa fa-pen"></i> </a>';
                    $btn = $btn . '<a href="javascript:;" class="btn btn-danger m-2 open_modal" data-toggle="modal" data-target="#deleteModalProduct" data-id="' . $row->id . '"> <i class="fas fa-trash"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['ProductImage', 'action'])
                ->filterColumn('select_product', function ($query, $keyword) {
                })
                ->filterColumn('ProductImage', function ($query, $keyword) {
                })
                ->filterColumn('CategoryName', function ($query, $keyword) {
                })
                ->make(true);
        }

        // return view('subject.index');

    }
}
