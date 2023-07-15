<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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


    /**
     * List User 
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function index()
    {
        
        
        return view('users.index');
    }
    
    /**
     * Create User 
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function create()
    {
        $roles =array('admin'=>'Admin','user'=>'User');
        return view('users.add', ['roles' => $roles]);
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
        // $request->validate([
        //     'first_name'    => 'required',
        //     'last_name'     => 'required',
        //     'email'         => 'required|unique:users,email',
        //     'mobile_number' => 'required|numeric|digits:10',
        //     'role_id'       =>  'required|exists:roles,id',
        //     'status'       =>  'required|numeric|in:0,1',
        // ]);

        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'         => 'required|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id'       =>  'required|in:Admin,User',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            DB::beginTransaction();
            try {
    
                // Store Data
                $user = User::create([
                    'name'    => $request->name,
                    'email'         => $request->email,
                    'mobile_no' => $request->mobile_number,
                    'role'       => $request->role_id,
                    'password'      => Hash::make(trim($request->name).'@'.$request->mobile_number)
                ]);
    
                // Commit And Redirected To Listing
                DB::commit();
                // return redirect()->route('users.index')->with('success','User Created Successfully.');
                return response()->json([
                    'status' => 200,
                    'error' =>  'User Created Successfully.'
                ]);
    
            } catch (\Throwable $th) {
                // Rollback and return with Error
                DB::rollBack();
                // return redirect()->back()->withInput()->with('error', $th->getMessage());
                return response()->json([
                    'status' => 400,
                    'error' =>  $th->getMessage()
                ]);
            }
        }

       
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success
     * @author Shani Singh
     */
    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success','User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     * @author Shani Singh
     */
    public function edit(User $user)
    {
        $roles =array('admin'=>'Admin','user'=>'User');
        return view('users.edit')->with([
            'roles' => $roles,
            'user'  => $user
        ]);
    }

    /**
     * Update User
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, User $user)
    {
        // Validations
        // $request->validate([
        //     'first_name'    => 'required',
        //     'last_name'     => 'required',
        //     'email'         => 'required|unique:users,email,'.$user->id.',id',
        //     'mobile_number' => 'required|numeric|digits:10',
        //     'role_id'       =>  'required|exists:roles,id',
        //     'status'       =>  'required|numeric|in:0,1',
        // ]);

        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'         => 'required|unique:users,email,'.$user->id.',id',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id'       =>  'required|in:Admin,User',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            

            DB::beginTransaction();
            try {

                // Store Data
                $user_updated = User::whereId($user->id)->update([
                    'name'    => $request->name,
                    'email'         => $request->email,
                    'mobile_no' => $request->mobile_number,
                    'role'       => $request->role_id,
                ]);

                // Commit And Redirected To Listing
                DB::commit();
                // return redirect()->route('users.index')->with('success','User Updated Successfully.');
                return response()->json([
                    'status' => 200,
                    'message' =>  'User Updated Successfully.'
                ]);

            } catch (\Throwable $th) {
                // Rollback and return with Error
                DB::rollBack();
                // return redirect()->back()->withInput()->with('error', $th->getMessage());
                return response()->json([
                    'status' => 400,
                    'error' =>  $th->getMessage()
                ]);
            }
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
            User::whereId($request->id)->delete();

            DB::commit();
            toastr()->success('User Deleted Successfully');
            return redirect()->route('users.index')->with('success', 'User Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
     

    /**
     * Import Users 
     * @param Null
     * @return View File
     */
    public function importUsers()
    {
        return view('users.import');
    }


      //ajax form add edit
    public function addForm(Request $request){
        $roles = array('Admin'=>'Admin','User'=>'User');
        $returnHTML = view('users.add_form',['roles'=>$roles])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
        // return view('subject.index');
        
    }

    public function editForm(User $user){
        $roles = array('Admin'=>'Admin','User'=>'User');
        $returnHTML = view('users.edit_form',['user'=>$user,'roles'=>$roles])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
        // return view('subject.index');
        
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
    
            
            $this->temp_row_id = $temp_row_id; 
            $data = User::select(User::raw('users.*'));
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('select_mediums', function ($row)  {

                        return get_chkbox_row($row,$this->temp_row_id);
                    })
                    ->addColumn('action', function($row){
       
                           $btn = '<a href="javasctipt:;" data-method="'.route('users.users-edit-form', ['user' => $row->id]).'" class="btn btn-primary m-2 open_my_form_form"> <i class="fa fa-pen"></i> </a>';
                           $btn = $btn.'<a href="javascript:;" class="btn btn-danger m-2 open_modal" data-toggle="modal" data-target="#deleteModalUser" data-id="'.$row->id.'"> <i class="fas fa-trash"></i> </a>';

                           
         
                            return $btn;
                    })
                    ->rawColumns(['select_mediums','action'])
                    ->filterColumn('select_mediums', function($query, $keyword) {
                        
                    })
                    ->make(true);
        }
        
        // return view('subject.index');
        
    }

}
