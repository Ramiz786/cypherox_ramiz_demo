<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Exports\CategoryModelExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use DataTables;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryController extends Controller
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
        $category = CategoryModel::paginate(10);
        return view('category.index', ['category' => $category]);
    }


    //ajax form add edit
    public function addForm(Request $request){
        $categories = CategoryModel::where('Parent',0)->orderBy('Name', 'ASC')->get();
        $returnHTML = view('category.add_form',['categories'=>$categories])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
        // return view('subject.index');
        
    }

    public function editForm(CategoryModel $category){
        $categories = CategoryModel::where('Parent',0)->orderBy('Name', 'ASC')->get();
        $returnHTML = view('category.edit_form',['categories'=>$categories,'category'=>$category])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
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
       
        return view('category.add');
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
            'category_name'=> 'required|unique:tbl_category,Name',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $user = CategoryModel::create([
                'Name'    => $request->category_name,
                'Parent' => ($request->ParentCategory) ? $request->ParentCategory : 0,
                'CreatedBy'    => $request->user()->id,
                'CreatedOn'    => date('Y-m-d'),
            ]);
            return response()->json([
                'status'=>200,
                'message'=>'Category Added Successfully.'
            ]);
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     * @author Shani Singh
     */
    public function edit(CategoryModel $category)
    {
        return view('category.edit')->with([
            'medium'  => $category
        ]);
    }

    /**
     * Update CategoryModel
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, CategoryModel $category)
    {
        // Validations

        $validator = Validator::make($request->all(), [
            'category_name'=> 'required|unique:tbl_category,Name,'.$category->id.',id',
            
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $category_update = CategoryModel::whereId($category->id)->update([
                'Name'    => $request->category_name,
                'Parent'    => ($request->ParentCategory) ? $request->ParentCategory : 0,
            ]);
            return response()->json([
                'status'=>200,
                'message'=>'Category Updated Successfully.'
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
            CategoryModel::whereId($request->id)->delete();
            
            DB::commit();
            toastr()->success('Inquiry Deleted Successfully');
            return redirect()->route('inquiry.index')->with('success', 'Inquiry Deleted Successfully!.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function bulkDelete(Request $request){
        $validator = Validator::make($request->all(), [
            'row_id'=> 'required|array',
            
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $row_ids = $request->row_id;
            DB::beginTransaction();
            try {
                // Delete User
                foreach($row_ids as $single_row){
                    CategoryModel::whereId($single_row)->delete();
                }

                DB::commit();
                // toastr()->success('CategoryModel Deleted Successfully');
                // return redirect()->route('category.index')->with('success', 'CategoryModel Deleted Successfully!.');
                return response()->json([
                    'status'=>200,
                    'message'=>'CategoryModel Deleted Successfully.'
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

    public function getDatatable(Request $request){

        if ($request->ajax()) {

            $row_ids= $request->row_ids;

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
            $data = CategoryModel::select(CategoryModel::raw('tbl_category.*,"1" as select_category,(CASE WHEN parent.Name IS NULL THEN "-" ELSE parent.Name END) as ParentName'))->leftJoin('tbl_category as parent', 'tbl_category.Parent', '=', 'parent.id');
            return Datatables::of($data)
                    ->addIndexColumn()
                   
                    ->addColumn('action', function($row){
       
                           $btn = '<a href="javasctipt:;" data-method="'.route('category.category-edit-form', ['category' => $row->id]).'" class="btn btn-primary m-2 open_my_form_form"> <i class="fa fa-pen"></i> </a>';
                           $btn = $btn.'<a href="javascript:;" class="btn btn-danger m-2 open_modal" data-toggle="modal" data-target="#deleteModalCategory" data-id="'.$row->id.'"> <i class="fas fa-trash"></i> </a>';
                           
                            return $btn;
                    })
                    ->rawColumns(['select_category','action'])
                    ->filterColumn('select_category', function($query, $keyword) {
                        
                    })
                    ->make(true);
        }
        
        // return view('subject.index');
        
    }

   
}
