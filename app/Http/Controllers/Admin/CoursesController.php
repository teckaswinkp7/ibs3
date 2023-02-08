<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use DB;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function __construct() {       
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->user_role;
            if($this->id != 1)
            {
                return redirect('unauthorized');
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
        $courses = DB::table('courses')->select('*')->paginate(5);
        $users = DB::table('users')
        ->join('education','users.id','=','education.stu_id')
        ->select('users.name','education.updated_at','users.id')
        ->where('users.user_role',2)
        ->where('users.status',2)->get();
        $programme = DB::table('categories')->get();
        $studytype = DB::table('study_period')->get();
        $fromdate = "NULL";
        $todate = "NULL";
        
        return view('admin.courses.index',compact('courses','users','programme','studytype','fromdate','todate'));
        //return view('categories.index', compact('categories'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
       $category=Category::where('parent_id', null)->orderby('name', 'asc')->get();
       $subcategory=Category::whereNotNull('parent_id')->get();
       $studytype = DB::table('study_period')->get();
       return view('admin.courses.create',compact('studytype'))->with('category',$category)->with('subcategory',$subcategory);
        //return view('categories.create');
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
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'slug'      => 'required|unique:courses',
        'course_image'=>'required',
        'parent_id' => 'nullable|numeric',
        ]);
        $courses = new Courses;
        $courses->name = $request->name;
        $courses->slug = $request->slug;
        $courses->start_date = $request->start_date;
        $courses->course_duration = $request->course_duration;
        $courses->course_id = $request->course_id;
        $courses->price = $request->price;
        $courses->cat_id = $request->cat_id;
        $courses->subcat_id = $request->subcat_id;
        $courses->study_type = $request->study_type;
        if($request->file('course_image')){
        $file= $request->file('course_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $courses->course_image= $filename;
        }
        $courses->short_description = $request->short_description;
        $courses->description = $request->description;
        $courses->save();
        return redirect()->route('courses.index')
        ->with('success','Courses has been created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Courses $courses)
    {
    return view('courses.show',compact('courses'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $category = Category::where('parent_id',null)->get();   
        $subcategory=Category::whereNotNull('parent_id')->get();
        //dd($subcategory);  
        $course = Courses::findOrFail($id);       
        //return view('courses.edit',compact('category','course'));
        return view('admin.courses.edit',compact('category','course','subcategory'));
        
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

        $course = Courses::findOrFail($id);
        //dd($course);
        /*if($request->name != $course->name || $request->parent_id != $course->parent_id)
        {
            if(isset($request->parent_id))
            {
                $checkDuplicate = Courses::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
                if($checkDuplicate)
                {
                    return redirect()->back()->with('error', 'Category already exist in this parent.');
                }
            }
            else
            {
                $checkDuplicate = Courses::where('name', $request->name)->where('parent_id', null)->first();
                if($checkDuplicate)
                {
                    return redirect()->back()->with('error', 'Category already exist with this name.');
                }
            }
        }*/  
        $course->name = $request->name;
        $course->slug = $request->slug;
        $course->cat_id = $request->cat_id;
        $course->subcat_id = $request->subcat_id;
        //dd($request);
        if($request->file('course_image')){
        $file= $request->file('course_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $course->course_image= $filename;
        }
        $course->course_duration = $request->course_duration;
        $course->course_id = $request->course_id;
        $course->short_description = $request->short_description;
        $course->description = $request->description;
        $course->save();
        return redirect()->route('courses.index')
        ->with('success','Courses Has Been updated successfully');   
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
    $products = Courses::destroy($id);    
    return redirect()->route('courses.index')
    ->with('success','Courses has been deleted successfully');
    }



    public function searchcoursedate(Request $request){


        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $studytype = $request->studytype;


 

        $courses = DB::table('courses')->select('*')
        ->whereBetween('start_date',[$fromdate,$todate])
        ->orwhere('study_type',$studytype)
        ->paginate(5);
       $users = DB::table('users')
       ->join('education','users.id','=','education.stu_id')
       ->select('users.name','education.updated_at','users.id')
       ->where('users.user_role',2)
       ->where('users.status',2)->get();
       $programme = DB::table('categories')->get();
       $studytype = DB::table('study_period')->get();
       
       return view('admin.courses.index',compact('courses','users','programme','studytype','fromdate','todate'));




    }


    public function coursesearch(Request $request){


        $search = $request->search;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $courses = DB::table('courses')->select('*')
        ->where('name','LIKE','%'.$search.'%')
        ->paginate(5);
       $users = DB::table('users')
       ->join('education','users.id','=','education.stu_id')
       ->select('users.name','education.updated_at','users.id')
       ->where('users.user_role',2)
       ->where('users.status',2)->get();
       $programme = DB::table('categories')->get();
       $studytype = DB::table('study_period')->get();
       
       return view('admin.courses.index',compact('courses','users','programme','studytype','fromdate','todate'));



    }
}
