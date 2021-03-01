<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Userrole;

use App\Models\Routesmanager;

use App\Models\UserPermission;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;



class UsersController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        if ($request->ajax()) {

            $data = User::latest()->get();

            return DataTables::of($data)

                ->editColumn('user_role', function ($data) {

                        $role = Userrole::find($data->user_role);

                        return $role ? $role->role_name :'Normal user';

                    })

                    ->addColumn('action', function($data){

                        $edit = route('admin.users.edit',$data->id);

                        $delete = route('admin.users.destroy',$data->id);

                        $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';

                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';

                        return $button;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

        return view('admin.users.index');

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Userrole::all();

        $userroles = array();

        foreach ($roles as $role) {

            $userroles[$role->id] =$role->role_name;

        }

        $routes = Routesmanager::all();

        $moduleroute =array();

        foreach ($routes as  $route) {

           $moduleroute[$route->module_name][$route->id] =$route->route_action;

        }

        //echo"<pre>";print_r($moduleroute);die;

        $permissions = array();

        return view('admin.users.addoredit',compact('userroles','moduleroute','permissions'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //echo"<pre>";print_r($request->all());die;

        $rules = array(

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required',

        );

        $validator = Validator::make($request->all(), $rules);



        // process the login

        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);

        }else{



            $data = $request->except(['_token','permission']);

            $data['password'] = Hash::make($data['password']);



            $user = User::create($data);



            $permission =$request->permission;

            

            if(!empty($permission)){

                foreach ($permission as $route) {

                    UserPermission::insert(['user_id'=>$user->id,'route_id'=>$route]);

                }    

            }

            

            if($user){

                return back()->with('success','Added successfully');

            }else{

                return back()->with('error','Something Wrong');

            }

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {   

        $userroles = array();

        $roles = Userrole::all();

        foreach ($roles as $role) {

            $userroles[$role->id] =$role->role_name;

        }



        $routes = Routesmanager::all();

        $moduleroute =array();

        foreach ($routes as  $route) {

           $moduleroute[$route->module_name][$route->id] =$route->route_action;

        }

        $permissions = UserPermission::where('user_id', $id)->pluck('route_id')->toArray();

        // echo"<pre>";print_r($permissions);die;

        $user = User::find($id);

        return view('admin.users.addoredit',compact('user','userroles','moduleroute','permissions'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

       // dd($request->all());

        // validate

        // read more on validation at http://laravel.com/docs/validation

        $rules = array(

            'name' => 'required',

            'email' => 'required|email|unique:users,email,'.$id,

            //'password' => 'required',

        );

        $validator = Validator::make($request->all(), $rules);



        // process the login

        if ($validator->fails()) {

           return back()->withInput()->withErrors($validator);

        } else {

            $data = $request->except(['_token','_method','permission']);

            $plan = User::where('id', $id)->update($data);



          //  $userpermission = UserPermission::where('user_id', $id)->pluck('route_id')->toArray();

            $permission =$request->permission;

            UserPermission::whereNotIn('route_id', $permission)->where('user_id', $id)->delete();

            

            if(!empty($permission)){

                foreach ($permission as $route) {

                     UserPermission::updateOrCreate(['user_id'=>$id,'route_id'=>$route], 

                        ['user_id'=>$id,'route_id'=>$route]);                  

                }    

            }



            if($plan){

            return back()->with('success','Successfully updated');

            }else{

                return back()->with('error','Something Wrong');

            }

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

       // delete

        $plan = User::find($id);

        if($plan->delete()){

            return true;

        }else{

            return false;



        }

    }



    public function UserRoles(Request $request){

        if ($request->ajax()) {

            $data = Userrole::latest()->get();

            return DataTables::of($data)

                    ->addColumn('action', function($data){

                        $edit = route('admin.editrole',$data->id);

                        $delete = route('admin.destroyUserRole',$data->id);

                        $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';

                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';

                        return $button;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

        return view('admin.users.userrolelist');

    }



    public function Addrole(Request $request){

        if($request->isMethod('post')){

            $rules = array(

            'role_name' => 'required|unique:userroles,role_name',

        );

        $rolename = str_slug($request->role_name,'_');

        $request->merge(['role_name' => $rolename]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);

        }else{

            $data = $request->except(['_token']);

            $user = Userrole::insert($data);

            if($user){

                return back()->with('success','Added successfully');

            }else{

                return back()->with('error','Something Wrong');

            }

        }



        }else{

            return view('admin.users.userrole');

        }

    }



    public function Editrole($id, Request $request){

        $userrole = Userrole::find($id);



        if($request->isMethod('post')){

            $rules = array(

            'role_name' =>'required|unique:userroles,role_name,'.$id,

            );

            $request->role_name = str_slug($request->role_name);

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return back()->withInput()->withErrors($validator);

            }else{

                $data = $request->except(['_token']);

                $userrole = $userrole->update($data);

                if($userrole){

                    return back()->with('success','update successfully');

                }else{

                    return back()->with('error','Something Wrong');

                }

            }



        }else{

            return view('admin.users.userrole',compact('userrole'));

        }

    }



    public function destroyUserRole($id)

    {

       // delete

        $plan = Userrole::find($id);

        if($plan->delete()){

            return true;

        }else{

            return false;



        }

    }

}

