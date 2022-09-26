<?php
  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Studentcourse;
  
class PDFController extends Controller
{
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
        $pdf = PDF::loadView('admin.myPDF',$data);

        //return $pdf->download('invoice.pdf');
        $ab = $pdf->download(public_path('public/uploads/attachment/','invoice.pdf'));
        
        //dd($ab);
        //path/to/file/image.jpg

        // $filename = 'temp-image.jpg';
        // $tempImage = tempnam(sys_get_temp_dir(), $filename);
        
        // return response()->download($tempImage, $filename);
        return view('admin.myPDF', $data);
    }
}