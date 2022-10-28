<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Studentcourse;

  
class PDFController extends Controller
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
    public function generateInvoicePDF($id)
    {
        $data['invoice_id'] = '#INV-'.time();

        $data['users'] = User::where('id',$id)->get();        
        $uid=(int) $id;        
        $data['student_course_invoice']= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
            "courses.price"
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get();   

        //dd($student_course_invoice);
        $path = public_path('pdf');
        //$path = storage_path('pdf/');
        $pdf = PDF::loadView('admin.myPDF',$data);
        //Storage::put('public/pdf/invoice.pdf', $pdf->output());
        $ac = $pdf->save($path.'/'.rand(0000,9999).'invoice.pdf');
        //dd($ac);
        return $pdf->download('invoice.pdf');    
        
        //return Response::$pdf->download($path, $fileName, ['Content-Type: application/zip']);


        //return $pdf->download('invoice.pdf');
        // $ab = $pdf->download(public_path('public/uploads/attachment/','invoice.pdf'));
        
        // $content = $pdf->download()->getOriginalContent();

        // $aa = Storage::put('public/public/uploads/attachment/name.pdf',$content) ;
        // dd($aa);
        //dd($ab);
        //path/to/file/image.jpg

        // $filename = 'temp-image.jpg';
        // $tempImage = tempnam(sys_get_temp_dir(), $filename);
        
        // return response()->download($tempImage, $filename);
        //return view('admin.myPDF', $data);
    }
}