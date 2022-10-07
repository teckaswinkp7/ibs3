<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
class ProductCRUDController extends Controller
{
    public function __construct() {       
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->user_role;
            if($this->id != 1)
            {
                echo 'Unautohorized Access';
                die();
            }
            else{
                return $next($request);
            }
            
        });
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['products'] = Products::orderBy('id','desc')->paginate(5);
    return view('product.index', $data);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    $category=Category::where('parent_id',null)->get(); 
    //$category = Category::where('parent_id',0)->get();
    //$subcategory=Category::whereNotNull('parent_id')->get(); 
    //return view('product.create')->with('categories',$category)->with('subcategory',$subcategory);
    return view('product.create')->with('categories',$category);
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
    'slug' => 'required',
    'product_image'=>'required',
    'short_description' => 'required',
    'long_description' => 'required',
    'additional_information' => 'required',
    'sale_price' => 'required',
    'regular_price' => 'required',
    'cat_id' => 'required',
    'stock'=>'required',
    ]);
    $product = new Products;
    $product->name = $request->name;
    $product->slug = $request->slug;
    if($request->file('product_image')){
        $file= $request->file('product_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $product->product_image= $filename;
    }
    $product->short_description = $request->short_description;
    $product->long_description = $request->long_description;
    $product->additional_information = $request->additional_information;
    $product->sale_price = $request->sale_price;
    $product->regular_price = $request->regular_price;
    $product->cat_id = $request->cat_id;
    $product->subcat_id = $request->subcat_id;
    $product->is_featured = $request->is_featured;
    $product->stock = $request->stock;
    $product->save();
    return redirect()->route('product.index')
    ->with('success','Product has been created successfully.');
    }
    public function subCat(Request $request)
    {
         
        $parent_id = $request->cat_id;
         
        $subcategories = Category::where('id',$parent_id)
                              ->with('subcategories')
                              ->get();
        return response()->json([
            'subcategories' => $subcategories
        ],200);
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Products $products)
    {
    return view('prouct.show',compact('products'));
    } 
    public function edit($id)
    {
    $category = Category::where('parent_id',null)->get();     
    $products = Products::findOrFail($id);       
    return view('product.edit',compact('products','category'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'slug' => 'required',
        'short_description' => 'required',
        'long_description' => 'required',
        'additional_information' => 'required',
        'sale_price' => 'required',
        'regular_price' => 'required'
    ]);
    $products = Products::find($id);
    $products->name = $request->name;
    $products->slug = $request->slug;
    $products->is_featured = $request->is_featured;
    $products->cat_id = $request->cat_id;
    $products->subcat_id = $request->subcat_id;
    if($request->file('product_image')){
        $file= $request->file('product_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $products->product_image= $filename;
    }
    $products->short_description = $request->short_description;
    $products->long_description = $request->long_description;
    $products->additional_information = $request->additional_information;
    $products->sale_price = $request->sale_price;
    $products->regular_price = $request->regular_price;
    $products->save();
    return redirect()->route('product.index')
    ->with('success','Product Has Been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    $products = Products::destroy($id);    
    return redirect()->route('product.index')
    ->with('success','Product has been deleted successfully');
    }
}
