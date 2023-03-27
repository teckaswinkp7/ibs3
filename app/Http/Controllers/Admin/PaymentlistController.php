<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  DB;
use App\Models\User;
use App\Models\Payment;
use App\Exports\PaymentlistExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentlistController extends Controller
{
    

    public function index(){


        $fromdate = "NULL";
        $todate = "NULL";
        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount','fromdate','todate'));


    }



    public function paymentlistdatesearch(Request $request){



        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount','fromdate','todate'));


    }

    
    public function paymentlistnamesearch(Request $request){



        $search = $request->search;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $paymentlist = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename')
        ->where('users.name','LIKE','%'.$search.'%')
        ->orWhere('courses.name','LIKE','%'.$search.'%')
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount'));


    }


    public function exportpaymentlist(Request $request){



        return Excel::download(new PaymentlistExport,'paymentlist.xlsx');

    }


    public function xeroconnection($id){


//dd($id);
        
        $paymentdata = User::where('users.offer_accepted','yes')
        ->where('users.id',$id)
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->get();

        $coursename = $paymentdata[0]->coursename;

        $price = $paymentdata[0]->amountdue;

       //dd($price);

    //dd($var);
    $val=array(

         'Type'=>'ACCREC',
        'Contact'=>array('ContactID'=>'33ad4b97-ed47-4239-ae66-927296d5b1be'),
        'DueDate'=>date('Y-m-d'),
        'LineItems'=>array( array(
        'Description'=>$coursename,
        'Quantity'=>1,
        'UnitAmount'=>$price,
        'AccountCode'=>200,
        
     )
        
     ),
        
         'Status'=>'AUTHORISED'
        
        );

        //dd($val);

/*
$client_id = "4B5E2A3E9265455C91A676E32AB0ABC1";
$client_secret = "Mm0JUSUgyIIqc8zoKXoe_eC7mpil8tDkOJCJwwjnJdqPSwye";
$code = $_REQUEST['tXWz7ejbL01OHj0BaqSeSk_sUTfdcuzKL2bvb9VevpI'];
$site_url = $sugar_config['https://localhost/ibs/public/'];
$redirect_uri = "https://developer.xero.com";
$base64encode = base64_encode($client_id.":".$client_secret);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://identity.xero.com/connect/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri");    
$headers = array();
$headers[] = 'authorization: Basic '.$base64encode.'';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
*/
 /*   
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://identity.xero.com/connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=refresh_token&Scope=offline_access&refresh_token=nhJp5pUOE88QZUuldHgxLbvjQnFElQsC3lLpYiCcVg8',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic NEI1RTJBM0U5MjY1NDU1QzkxQTY3NkUzMkFCMEFCQzE6TW0wSlVTVWd5SUlxYzh6b0tYb2VfZUM3bXBpbDh0RGtPSkNKd3dqbkpkcVBTd3ll',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: _abck=E0AC8EE139A1B35B58FD3DE6DD28E3E3~-1~YAAQFSozagrmQAeHAQAApGIgFAk33cywLjrsXDX/3R5qZyQIYWyL1i8IPDMX3NGiDByYi3/SlHrC2gosLKz658flgj2+w9ZKdJ2lvHN9YMNK+HFQ67qn3cEoVh4kem1N1AIb7TMCItrz1N7HRYj2ACT6KMg6lxpHN4tMfDSy6mDmNpy56cXs8q4boEPrwyduicGupk3weRsc5a4AMccTeJ8gKrge5l3XmIDnUnOVYOsEsq3wvPiYLUlrPyTpaILT2xT+OKr1hRz82lrb/B8qRZu+SDLtP/AXqMVAnENlEm+21pBO3Pqk97skiaMYqNiQ+epVnIhzRSSNOkCpWYfy/F/k3It+4BsKnLJ8hy4hVTcILaUrPkwm2klNXToIZEOGEwefw7I=~-1~-1~-1; ak_bmsc=28EE8A340C1213374AE569AB6C6EFA50~000000000000000000000000000000~YAAQFSozagvmQAeHAQAApWIgFBNQImg0bVEmwcjDwNoldq1DcxVmbj8uZiPt/QpSqCmHnSzpWa0Cls1Uop+K2CKLY5loATsXZOHlPDWzjKuTUNIfatz8cElJhP2QD8lap8V78r5uR0Dw1VNkfqUHOwAIx5g1vQcrQb3jBSsFUyMSi31F+RQAVdHUeQtrfFXfLROvydqGLapJ/74yF1pL5jLWvi1SG2QHRTs7FvY6qOQF3B52wOe8zw8S9z1jD0aqXe02JTx2toIZeClDPekZeJoLepFWzAIWhPbRnjpp7Bt2FnEwxG+ewgPCdUtt+39E1ozol7CafRaC1SFr8khrzz1dLp8g1SqjaBbp2EDVl1dRZt3c+zC8HD6trg==; bm_sv=4805918002DA2FC5256A1B2C2C6BB616~YAAQFSozak1fQgeHAQAAKjc9FBPunqd4F4gciFfGI/sNN58Stp+6j6m1sB/agZq+wmemX1iiY9t/+o/hz4o/dzcofE6XRyODzsC0Ea2xDfVUIMWEKqZlMBMuKmBf6krCDohIcGw+bkxBgmwv5ln9FP09FBPsxSTI/fjV5pUenT4zPPAJMFJV9HUjiqQykOAdZ5DiVkDKcQeClaXhed4s3NszHZfbOKkv2oiq8Xp+G4UOmCH443tTuvvR6utKhNA=~1; bm_sz=EA95F8B48DEEFA80AFAF93F130CA3640~YAAQFSozagzmQAeHAQAApWIgFBMKNUTiYASWV8dX1yVXN9Bw3nU/NVO6iOxizSyjNUIlt1YNZglsMOxlZbVV7oR70KkegiFj/4X9dDpnE1VjQf+zjkHk0o3jsImdaLqZHp1rhPJa5R3yn7aUPD+a6lPaVT7aGP6vOFyiIiiUyeKJa2ThJUjnVzFVSzuC6vhSvTwBiWuTP6BMmHjzeXOj2Kz6qT5Ve4iSyvaagkNoXGkf1FZ5lZy8ZBjUxiYVhXf4b0fCHgEjx8eZRxpOPo7fgPN+S1jrc3Ugph6vEoQKYUJw~4342323~3616835; Device=a23a0cdbec1b4b848006b2dc78fdac81'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$tok = json_decode($response);

//dd($tok);
   */   
$access = 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjFDQUY4RTY2NzcyRDZEQzAyOEQ2NzI2RkQwMjYxNTgxNTcwRUZDMTkiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJISy1PWm5jdGJjQW8xbkp2MENZVmdWY09fQmsifQ.eyJuYmYiOjE2Nzk5MjI0MTgsImV4cCI6MTY3OTkyNDIxOCwiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS54ZXJvLmNvbSIsImF1ZCI6Imh0dHBzOi8vaWRlbnRpdHkueGVyby5jb20vcmVzb3VyY2VzIiwiY2xpZW50X2lkIjoiNEI1RTJBM0U5MjY1NDU1QzkxQTY3NkUzMkFCMEFCQzEiLCJzdWIiOiI2YjZjOGJlMWMwMTg1NTdiYmQ1NWVhNmUwZjZlZGIzYiIsImF1dGhfdGltZSI6MTY3OTkyMjM5OCwieGVyb191c2VyaWQiOiI3Y2M5ZDRjZS1hODJmLTQxMzktODAxYi0yNjZiMzBlZTFiZjAiLCJnbG9iYWxfc2Vzc2lvbl9pZCI6ImU0ZTI0NWE4MjIxYzQ5NTg5YmFlYTIyZjc2ZjYwZmNmIiwic2lkIjoiZTRlMjQ1YTgyMjFjNDk1ODliYWVhMjJmNzZmNjBmY2YiLCJqdGkiOiJCMTY1RTU3MEY2MjY4REFEQkZFOUVEODk5NDJCQUI0MSIsImF1dGhlbnRpY2F0aW9uX2V2ZW50X2lkIjoiYTQ1MTgyZTEtMDA3Yi00MzIyLTg4OWYtMzFmM2RkZWMwNDM1Iiwic2NvcGUiOlsiZW1haWwiLCJwcm9maWxlIiwib3BlbmlkIiwiYWNjb3VudGluZy5zZXR0aW5ncyIsImFjY291bnRpbmcudHJhbnNhY3Rpb25zIiwiYWNjb3VudGluZy5jb250YWN0cyIsIm9mZmxpbmVfYWNjZXNzIl0sImFtciI6WyJwd2QiXX0.gmAjFIQgpSunXQk1-tAiSuKxW_m-l2CVq9BqyJdGYs8LjoDEPf0UjX1EDdTwo_Szg_S4RA0v17pnKUlj_KxwbBIUisCu3OVI1gmvnW0WXxlUSi0FPqb-p2A37j6ynKpzyhsBjFCF8k1ejdyBeY5ZxASCEwGs9O5Ipz9CxDR8HhY2giC-Q_xRlI6eDINXzkWWt2dnQd5704UpfPEQcOVJ5wGwVevKKB_exWVmLfAAUPLtCpXvLHYEUzTwjTSuFsQ94tBqyXSPEghKkNFk_vNopcf08qvrrfCxlDN_rzgRFbgxPpV6nFdIEb32T3CtOPu3J_rliLxYAP9GSdFYF096oA';
       


    $curl = curl_init();
 
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Invoices',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>json_encode($val),
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'xero-tenant-id: e1f2436d-d61a-4449-b640-ba80a0bfa1ba',
        'Content-Type: application/json',
        'Authorization: Bearer '.$access.'',
        'Cookie: _abck=E0AC8EE139A1B35B58FD3DE6DD28E3E3~-1~YAAQFSozagrmQAeHAQAApGIgFAk33cywLjrsXDX/3R5qZyQIYWyL1i8IPDMX3NGiDByYi3/SlHrC2gosLKz658flgj2+w9ZKdJ2lvHN9YMNK+HFQ67qn3cEoVh4kem1N1AIb7TMCItrz1N7HRYj2ACT6KMg6lxpHN4tMfDSy6mDmNpy56cXs8q4boEPrwyduicGupk3weRsc5a4AMccTeJ8gKrge5l3XmIDnUnOVYOsEsq3wvPiYLUlrPyTpaILT2xT+OKr1hRz82lrb/B8qRZu+SDLtP/AXqMVAnENlEm+21pBO3Pqk97skiaMYqNiQ+epVnIhzRSSNOkCpWYfy/F/k3It+4BsKnLJ8hy4hVTcILaUrPkwm2klNXToIZEOGEwefw7I=~-1~-1~-1; ak_bmsc=28EE8A340C1213374AE569AB6C6EFA50~000000000000000000000000000000~YAAQFSozagvmQAeHAQAApWIgFBNQImg0bVEmwcjDwNoldq1DcxVmbj8uZiPt/QpSqCmHnSzpWa0Cls1Uop+K2CKLY5loATsXZOHlPDWzjKuTUNIfatz8cElJhP2QD8lap8V78r5uR0Dw1VNkfqUHOwAIx5g1vQcrQb3jBSsFUyMSi31F+RQAVdHUeQtrfFXfLROvydqGLapJ/74yF1pL5jLWvi1SG2QHRTs7FvY6qOQF3B52wOe8zw8S9z1jD0aqXe02JTx2toIZeClDPekZeJoLepFWzAIWhPbRnjpp7Bt2FnEwxG+ewgPCdUtt+39E1ozol7CafRaC1SFr8khrzz1dLp8g1SqjaBbp2EDVl1dRZt3c+zC8HD6trg==; bm_sv=4805918002DA2FC5256A1B2C2C6BB616~YAAQn5UvF6ZO+geHAQAArv44FBM/UaLSvb5u0Htk9med5iEQ12xWmQiW0Y8xF3kKp7bBBBbwCtX8zfAMTXa9uRjzUzwbZa+Xs3lhYYnP/Oc34vqnm9tPbbmSy/8D/rL+5TBZ8IhdPjgLStIH/ybYxdd1WG0ZlShQ08BXnWgGnsetXRoeFxJtdsfHIGPaF5zX4ZkXTK++2ALqYB1v4paGCnTjNyd+yPJp6yDS5G7aMPSKWly4IXDMLXZuFDIPISQ=~1; bm_sz=EA95F8B48DEEFA80AFAF93F130CA3640~YAAQFSozagzmQAeHAQAApWIgFBMKNUTiYASWV8dX1yVXN9Bw3nU/NVO6iOxizSyjNUIlt1YNZglsMOxlZbVV7oR70KkegiFj/4X9dDpnE1VjQf+zjkHk0o3jsImdaLqZHp1rhPJa5R3yn7aUPD+a6lPaVT7aGP6vOFyiIiiUyeKJa2ThJUjnVzFVSzuC6vhSvTwBiWuTP6BMmHjzeXOj2Kz6qT5Ve4iSyvaagkNoXGkf1FZ5lZy8ZBjUxiYVhXf4b0fCHgEjx8eZRxpOPo7fgPN+S1jrc3Ugph6vEoQKYUJw~4342323~3616835'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    
   
   
           
       
       $res = json_decode($response);
       
       //dd($res->Status);
   
       if($res->Status == "OK"){
   
        
   
           $update = payment::updateOrCreate([
   
   
               'stu_id'   => $id
   
           ],[
   
               'invoice_sync' => '1'
   
           ]);


   
   
   
           return redirect()->back()->with('success','Invoice synced successfully!');
       }
      else{
   
   
       return redirect()->back()->with('danger','Invoice sync Failed');
   
      }






    

   

      
      

    }
}
