<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Role;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['role'] = Role::all();
            return view('admin\role.index', $data);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        //$categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        //return view('categories.create', compact('categories'));
        
            return view('admin\role.create');
       
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required'
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->save();
        
        return redirect()->route('role.index')
        ->with('success','Role has been created successfully.');
    
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Role $role)
    {
     
            return view('admin/role.show',compact('role',$role));
       
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $roles = Role::findOrFail($id);    
        return view('admin/role.edit', compact('roles',$roles));
    }

    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id)
    {
    
    $validator = $request->validate([
    'name' => 'required'
    ]);

    $roles = Role::findOrFail($id);
    $roles->name = $request->name;
    $roles->save();
    return redirect()->route('role.index')
    ->with('success','Role Has Been updated successfully');   
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    $roles = Role::destroy($id);    
    return redirect()->route('role.index')
    ->with('success','Role has been deleted successfully');
    }

}
