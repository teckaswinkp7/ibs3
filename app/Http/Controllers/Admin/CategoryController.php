<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['categories'] = Category::orderBy('id','desc')->paginate(5);
    return view('admin.categories.index', $data);
    //return view('categories.index', compact('categories'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.categories.create', compact('categories'));
        
        //return view('categories.create');
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
        'name' => 'required',
        'slug'      => 'required|unique:categories',
        'cat_image'=>'required',
        'parent_id' => 'nullable|numeric',
        'description' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id =$request->parent_id;
        $category->description = $request->description;
        if($request->file('cat_image')){
        $file= $request->file('cat_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $category->cat_image= $filename;
        }
        $category->save();
        return redirect()->route('categories.index')
        ->with('success','Category has been created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Category $category)
    {
    return view('category.show',compact('category'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $category = Category::findOrFail($id);    
        //$categories = Category::where('parent_id', null)->where('id', '!=', $category->id); 
        $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->orderby('name', 'asc')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
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
    'name' => 'required',
    'slug' => 'required',
    'parent_id' => 'nullable|numeric',
    'description' => 'required'
    ]);

    $category = Category::findOrFail($id);
    if($request->name != $category->name || $request->parent_id != $category->parent_id)
    {
        if(isset($request->parent_id))
        {
            $checkDuplicate = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
            if($checkDuplicate)
            {
                return redirect()->back()->with('error', 'Category already exist in this parent.');
            }
        }
        else
        {
            $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
            if($checkDuplicate)
            {
                return redirect()->back()->with('error', 'Category already exist with this name.');
            }
        }
    }  
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->parent_id =$request->parent_id;
    $category->description = $request->description;
    if($request->file('cat_image')){
        $file= $request->file('cat_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $category->cat_image= $filename;
    }
    $category->save();
    return redirect()->route('categories.index')
    ->with('success','Category Has Been updated successfully');   
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Category $category)
    {
    $category->delete();
    return redirect()->route('categories.index')
    ->with('success','Category has been deleted successfully');
    }
    /*public function getChildByParent(Request $request){
        // return $request->all();
        $category=Category::findOrFail($request->id);
        $child_cat=Category::getChildByParentID($request->id);
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }*/
}
