<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use App\Models\Role;
use Session;
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
        
        $datesessionfrom = Session::forget('fromdate');
        $datesessionto = Session::forget('todate');
        $studeylevelsession = Session::forget('studylevel');
        $fieldsession = Session::forget('field');
        $universitysession = Session::forget('institute');
        $quali = Session::forget('qualification');


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
        //$enrollmentplaces = DB::table('courseselections')->join('courses','courses.id','courseselections.studentSelCid')->where('courseselections.studentSelCid','courses.id')->count();
        //dd($enrollmentplaces);


        
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
        
         $datesessionfrom = Session::put('fromdate',$fromdate);
         $datesessionto = Session::put('todate',$todate);
         $studeylevelsession = Session::put('studylevel',$studylevel);
         $fieldsession = Session::put('field',$category);
         $universitysession = Session::put('institute',$university);
         $qualifsession = Session::put('qualification',$quali);

            $courses = DB::table('courses')->select('*')
            
            ->when($request->fromdate!= null, function($q) use ($request){

                return $q->whereBetween('start_date',[$request->fromdate,$request->todate]);
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
        $category = "";
        $studyperiod = "";
        $studylevel = "";
        $university = "";
        $quali = "";

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
       $institute = DB::table('university')->get();
       $qualification = DB::table('programme')->get();
       
       return view('admin.courses.index',compact('courses','users','programme','institute','qualification','studytype','fromdate','todate','university','quali','studylevel','studyperiod','category'));



    }


    public function offer_accepted($id){


       //dd($id);
        $fromdate = Session::get('fromdate');
        $todate = Session::get('todate');
        $category = Session::get('field');
        $studyperiod = "";
        $studylevel = Session::get('studylevel');
        $university = Session::get('institute');
        $quali = Session::get('qualification');
        $idsession = Session::put('id',$id);
       
        $data1['role']= Role::all();
        DB::statement("SET SQL_MODE=''");
        $registeredstudents = DB::table('users')
        ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
        ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
        ->join('payment','users.id','=','payment.stu_id')
        ->where('courses.id',$id)
        ->where('users.user_role', 2)
        ->where('payment.balance_due','!=','0')
        ->groupBy('users.id')  
        ->select('users.*','courses.name as coursename') 
        ->paginate(5);

        

        
    
        return view('admin.reports.offer_accepted',$data1,compact('registeredstudents','fromdate','todate','studylevel','category','university','quali'));
    }




    public function searchofferaccepted(Request $request){


        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $category = Session::get('field');
        $studyperiod = "";
        $studylevel = Session::get('studylevel');
        $university = Session::get('institute');
        $quali = Session::get('qualification');
        $id = Session::get('id');

       

        $registeredstudents = DB::table('users')
        ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
        ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
        ->join('payment','users.id','=','payment.stu_id')
        ->where('courses.id',$id)
        ->where('users.user_role', 2)
        ->where('payment.balance_due','!=','0')
        ->groupBy('users.id')  
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->groupBy('users.id')    
        ->select('users.*','courses.name as coursename')  
        ->paginate(5);


        return view('admin.reports.offer_accepted',compact('registeredstudents','fromdate','todate','category','studyperiod','studylevel','university','quali'));



    }


    public function namesearchofferaccepted(Request $request){


        $search = $request->search;

        

        $fromdate = "NULL";
        $todate = "NULL";
        $category = "";
        $studyperiod = "";
        $studylevel = "";
        $university = "";
        $quali = "";
        $id = Session::get('id');

        //dd($id);

        $registeredstudents = DB::table('users')
        ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
        ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
        ->join('payment','users.id','=','payment.stu_id')
        ->where('courses.id',$id)
        ->where('users.user_role', 2)
        ->where('payment.balance_due','!=','0')
        ->where('users.name', 'LIKE','%'.$search.'%')  
        ->select('users.*','courses.name as coursename')     
        ->paginate(5);


        return view('admin.reports.offer_accepted',compact('registeredstudents','fromdate','todate','category','studyperiod','studylevel','university','quali'));



    }


    public function exportUsers(Request $request){
        
        
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function enrolledusers($id){


        //dd($id);
         $fromdate = Session::get('fromdate');
         $todate = Session::get('todate');
         $category = Session::get('field');
         $studyperiod = "";
         $studylevel = Session::get('studylevel');
         $university = Session::get('institute');
         $quali = Session::get('qualification');
         $idsession = Session::put('id',$id);
        
         $data1['role']= Role::all();
         DB::statement("SET SQL_MODE=''");
         $registeredstudents = DB::table('users')
         ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
         ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
         ->join('payment','users.id','=','payment.stu_id')
         ->where('courses.id',$id)
         ->where('users.user_role', 2)
         ->where('payment.balance_due','=','0')
         ->groupBy('users.id')  
         ->select('users.*','courses.name as coursename') 
         ->paginate(5);
 
         
           
         
     
         return view('admin.reports.enrolledusers',$data1,compact('registeredstudents','fromdate','todate','studylevel','category','university','quali'));
     }
 
 
 
 
     public function searchenrolledusers(Request $request){
 
 
         $fromdate = $request->fromdate;
         $todate = $request->todate;
         $category = Session::get('field');
         $studyperiod = "";
         $studylevel = Session::get('studylevel');
         $university = Session::get('institute');
         $quali = Session::get('qualification');
         $id = Session::get('id');
 
        
 
         $registeredstudents = DB::table('users')
         ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
         ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
         ->join('payment','users.id','=','payment.stu_id')
         ->where('courses.id',$id)
         ->where('users.user_role', 2)
         ->where('payment.balance_due','=','0')
         ->groupBy('users.id')  
         ->whereBetween('users.updated_at',[$fromdate,$todate])
         ->groupBy('users.id')    
         ->select('users.*','courses.name as coursename')  
         ->paginate(5);
 
 
         return view('admin.reports.enrolledusers',compact('registeredstudents','fromdate','todate','category','studyperiod','studylevel','university','quali'));
 
 
 
     }
 
 
     public function namesearchenrolledusers(Request $request){
 
 
         $search = $request->search;
 
         $fromdate = "NULL";
         $todate = "NULL";
         $category = "";
         $studyperiod = "";
         $studylevel = "";
         $university = "";
         $quali = "";
         $id = Session::get('id');
 
         $registeredstudents = DB::table('users')
         ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
         ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
         ->join('payment','users.id','=','payment.stu_id')
         ->where('courses.id',$id)
         ->where('users.user_role', 2)
         ->where('payment.balance_due','=','0')
         ->groupBy('users.id')  
         ->where('users.name', 'LIKE','%'.$search.'%')
         ->groupBy('users.id')   
         ->select('users.*','courses.name as coursename')     
         ->paginate(5);
 
 
         return view('admin.reports.enrolledusers',compact('registeredstudents','fromdate','todate','category','studyperiod','studylevel','university','quali'));
 
 
 
     }
 
 
     public function exportenrolledUsers(Request $request){
         
         
         return Excel::download(new ExportUser, 'users.xlsx');
     }

}
