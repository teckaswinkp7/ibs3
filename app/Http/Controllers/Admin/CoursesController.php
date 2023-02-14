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
        $institute = DB::table('university')->get();
        $qualification = DB::table('programme')->get();
        $fromdate = "NULL";
        $todate = "NULL";
        $category = "";
        $studyperiod = "";
        $studylevel = "";
        $university = "";
        $quali = "";


        
        return view('admin.courses.index',compact('courses','users','programme','studytype','fromdate','todate','category','qualification','institute','studyperiod','studylevel','university','quali'));
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
       $institute = DB::table('university')->get();
       $subcategory=Category::whereNotNull('parent_id')->get();
       $studytype = DB::table('study_period')->get();
       $programme = DB::table('programme')->get();
       return view('admin.courses.create',compact('studytype','institute','programme'))->with('category',$category)->with('subcategory',$subcategory);
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
        
        $this->validate($request,[


            'name' => 'string|required',
            'slug' => 'string|required',
            'start_date' => 'required',
            'field' => 'string|required',
            'programme'


        ]);
       
        if ($request->hasFile('course_image')) {
            $fileName = $request->course_image->getClientOriginalName();
            $path = $request->course_image->move(public_path('/courseimage'), $fileName);
        }


        $courses = Courses::create([


            'name' => $request->name,
            'slug' => $request->slug,
            'start_date' => $request->start_date,
            'course_id' =>$request->course_id,
            'course_image' => $request->course_image,
            'field' =>$request->field,
            'study_level' =>$request->study_level,
            'institute' => $request->institute,
            'programme' => $request->prog,
            'short_description' => $request->short_description,
            'description' =>$request->description



        ]);

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
        $studylevel = $request->study_level;
        $category = $request->field;
        $university = $request->institute;
        $quali = $request->qualification;
        


            $courses = DB::table('courses')->select('*')
            
            ->when($request->fromdate!= null, function($q) use ($request){

                return $q->whereBetween('start_date',[$fromdate,$todate]);
            })
            ->when($request->institute!= null, function($q) use ($request){
                return $q->where('institute',$request->institute);
            })
            ->when($request->qualification!= null,function($q) use ($request){

                return $q->where('programme',$request->qualification);
            })
            ->when($request->field!=null, function($q) use ($request){

                return $q->where('field',$request->field);
            })
            ->when($request->study_level!= null,function($q) use ($request){

                return $q->where('study_level', $request->study_level);
            })
            ->paginate(5);

        

       
       $users = DB::table('users')
       ->join('education','users.id','=','education.stu_id')
       ->select('users.name','education.updated_at','users.id')
       ->where('users.user_role',2)
       ->where('users.status',2)->get();
       $programme = DB::table('categories')->get();
       $studytype = DB::table('study_period')->get();
       $institute = DB::table('university')->get();
       $qualification = DB::table('programme')->get();
       
       return view('admin.courses.index',compact('courses','users','programme','studytype','studylevel','fromdate','todate','category','institute','university','qualification','quali'));




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
