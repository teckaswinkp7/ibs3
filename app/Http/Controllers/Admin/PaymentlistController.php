<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  DB;
use App\Models\User;
use App\Models\Payment;
use App\Models\xeroapi;
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
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
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
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
        ->whereBetween('users.updated_at',[$fromdate,$todate])
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
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
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.invoice_sync','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
        ->where('users.name','LIKE','%'.$search.'%')
        ->orWhere('courses.name','LIKE','%'.$search.'%')
        ->paginate(4);
        $paymentcount = User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
        ->count();


        return view('admin.reports.paymentlistpanel',compact('paymentlist','paymentcount'));


    }


    public function exportpaymentlist(Request $request){



        return Excel::download(new PaymentlistExport,'paymentlist.xlsx');

    }


    public function xeroconnection($id){

      //  $res = $this->xero_refresh();
//dd($id);
        
        $paymentdata = User::where('users.offer_accepted','yes')
        ->where('users.id',$id)
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename','payment.payreciept')
        ->get();

        $coursename = $paymentdata[0]->coursename;

        $price = $paymentdata[0]->amountdue;

       //dd($price);

       $refresh = DB::table('xeroapi')->pluck('refresh_token');

     

      // dd($refresh[0]);
       
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
  CURLOPT_POSTFIELDS => 'grant_type=refresh_token&client_id=4B5E2A3E9265455C91A676E32AB0ABC1&refresh_token='.$refresh[0].'',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic NEI1RTJBM0U5MjY1NDU1QzkxQTY3NkUzMkFCMEFCQzE6TW0wSlVTVWd5SUlxYzh6b0tYb2VfZUM3bXBpbDh0RGtPSkNKd3dqbkpkcVBTd3ll',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: _abck=E0AC8EE139A1B35B58FD3DE6DD28E3E3~-1~YAAQBCozatJZghGHAQAALXF8MQnSlnNMkneD/klCtwvc69dO0Kc0BHrW/ZePmQPkmweWJ1b4j01pTyufOYmVknsG433z9tQk7iSNKSqHHJsLaHrD1y4PSxq6LPXdqCF0wB8oUIrviHHDU3/VaWGmF3Y+x5WMdxXVBBmKSBgm5vZzP2EGt3Krt+mwizGNR6sgGCcMv9Lq5PCXXdTW9k16cTOcVl06wVEDz+Mo5xtUsAnZ+wRRMMAs5GamgaYv64JDnicdpErzSzNWY0pYbPTb7NPbcDOzISSg/aTmpFiCzMXwp4XOkg7ck/EGl0AF0NReSLxEZTTPLRn69SVWLQngfX/nc7W0E0JbiCquLdRi7J1wRge/17Ou0Sb3NIXMoatqhHDXEJQ=~-1~-1~-1; ak_bmsc=D7CEE4CD7EB33719C690BAC6973621AF~000000000000000000000000000000~YAAQBCozauS4jBGHAQAAwbT3MROzoeGmCXKOpsQ4V1xSvpZq2SV6DKpCjU+y+Rb30wNkZJr/8EsBKNUbt+vJ84JyckPwLDe4I79IGWjgV8Hnyu6SaajBG6LKIiENIafiNIgidFmGy6DFhSvGZIPEhLKmf/hKQX5565Mc34EwkZmbi8oPOGYv52nuhofkwDM+BOc6K6PSIGTzhXHFwdPGokGZV4ZwTCxUQn5iBs+PK80ostUqDm4aj7+IRDJAvYgrhLT0Pqi4gPUb4Z+nPrhwCvH4MCk3Mvv/TbioN+MarKYnQph+Ki+gGCw2DYZiaLgGwOIO3+NQAPhIALTZqjilmitbdWV2/aZ8jsQZwNjZxtVTQvvBy7EZvWSQJA==; bm_sv=6F2C6580CFD8F99BBD3D0437DB7C8F89~YAAQBCozasR8jhGHAQAAaYQLMhNaiVoZMBQFeYw6VsbTfxsT0xwoU/Lb5aJgim4zXwMjX5YNhBELhDjmHmdFBiF0v/V6/UUnmZ6s+vdN1FPUIxaDjQPrumeqHJ7Itu6/APq4xzo8Rbz5vYHRTIAG1roDQwoZn6dd/5kUIeQjJEXYVxJ95wLfpv0Kb7WTCw5kM8a5Fv5YvYDp+AbR1gDgvHeJRJveXY8o495UwMrkiRH41FXmh6RQYthsr1C2eGI=~1; bm_sz=1C5AFC94FD923491BD7E05CEE8E956D0~YAAQBCozatRZghGHAQAALXF8MRO408Raj+ej0Y3dnv2tnsie+3e0pxXXVnGPAIrp2YAjaFxPBdXQ6latE1Ump2+x9yK9FHkiV9GQp4R2cvmhJXPXBwrYTObxjdo+kY+ZgrPF+qc/mvKbqtlTSH2TFw/cS7+gf0O1UuDy+uesMbhXCH4TnF4vKDO9fSBlFj2icNckH54eZxVdGhrcgp8LT7UGhHZIHafEyWWSX1V0y1cdql6pCQqdS4jY9+4gVmQh941+Zz4pCtHAAicjlX6VWIXi9RjjDwPAEz1TVFjUAdoK~4404804~3553328; Device=a23a0cdbec1b4b848006b2dc78fdac81'
  ),
));

$response = curl_exec($curl);

curl_close($curl);



$tok = json_decode($response);

//dd($tok->error);
$refreshtoken =  $tok->refresh_token;

$refreshpost = DB::table('xeroapi')->where('id','=','1')->update(['refresh_token' => $refreshtoken]);



//array_push($emp,$refresh);
//dd($refresh);

//dd($tok);

//dd($refresh);


//$emp = Session::put('rtk',$refresh);


$access = $tok->access_token;
       


    $curl = curl_init();
 
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Invoices',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
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
       
      //dd($res);
   
       if($res->Status == "OK"){
   
        
   
           $update = payment::where('stu_id',$id)->update(['invoice_sync' => '1']);

    //   User::where('email', $userEmail) ->update([ 'member_type' => $plan ]);

       // dd($update);
   
   
   
           return redirect()->back()->with('success','Invoice synced successfully!');
       }
      else{
   
   
       return redirect()->back()->with('danger','Invoice sync Failed');
   
      }

}

    /*
    public function xero_refresh($vals)
    {
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
        CURLOPT_POSTFIELDS => 'grant_type=refresh_token&client_id=4B5E2A3E9265455C91A676E32AB0ABC1&refresh_token='.$vals.'',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic NEI1RTJBM0U5MjY1NDU1QzkxQTY3NkUzMkFCMEFCQzE6TW0wSlVTVWd5SUlxYzh6b0tYb2VfZUM3bXBpbDh0RGtPSkNKd3dqbkpkcVBTd3ll',
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: _abck=E0AC8EE139A1B35B58FD3DE6DD28E3E3~-1~YAAQBCozatJZghGHAQAALXF8MQnSlnNMkneD/klCtwvc69dO0Kc0BHrW/ZePmQPkmweWJ1b4j01pTyufOYmVknsG433z9tQk7iSNKSqHHJsLaHrD1y4PSxq6LPXdqCF0wB8oUIrviHHDU3/VaWGmF3Y+x5WMdxXVBBmKSBgm5vZzP2EGt3Krt+mwizGNR6sgGCcMv9Lq5PCXXdTW9k16cTOcVl06wVEDz+Mo5xtUsAnZ+wRRMMAs5GamgaYv64JDnicdpErzSzNWY0pYbPTb7NPbcDOzISSg/aTmpFiCzMXwp4XOkg7ck/EGl0AF0NReSLxEZTTPLRn69SVWLQngfX/nc7W0E0JbiCquLdRi7J1wRge/17Ou0Sb3NIXMoatqhHDXEJQ=~-1~-1~-1; ak_bmsc=D7CEE4CD7EB33719C690BAC6973621AF~000000000000000000000000000000~YAAQBCozauS4jBGHAQAAwbT3MROzoeGmCXKOpsQ4V1xSvpZq2SV6DKpCjU+y+Rb30wNkZJr/8EsBKNUbt+vJ84JyckPwLDe4I79IGWjgV8Hnyu6SaajBG6LKIiENIafiNIgidFmGy6DFhSvGZIPEhLKmf/hKQX5565Mc34EwkZmbi8oPOGYv52nuhofkwDM+BOc6K6PSIGTzhXHFwdPGokGZV4ZwTCxUQn5iBs+PK80ostUqDm4aj7+IRDJAvYgrhLT0Pqi4gPUb4Z+nPrhwCvH4MCk3Mvv/TbioN+MarKYnQph+Ki+gGCw2DYZiaLgGwOIO3+NQAPhIALTZqjilmitbdWV2/aZ8jsQZwNjZxtVTQvvBy7EZvWSQJA==; bm_sv=6F2C6580CFD8F99BBD3D0437DB7C8F89~YAAQBCozasR8jhGHAQAAaYQLMhNaiVoZMBQFeYw6VsbTfxsT0xwoU/Lb5aJgim4zXwMjX5YNhBELhDjmHmdFBiF0v/V6/UUnmZ6s+vdN1FPUIxaDjQPrumeqHJ7Itu6/APq4xzo8Rbz5vYHRTIAG1roDQwoZn6dd/5kUIeQjJEXYVxJ95wLfpv0Kb7WTCw5kM8a5Fv5YvYDp+AbR1gDgvHeJRJveXY8o495UwMrkiRH41FXmh6RQYthsr1C2eGI=~1; bm_sz=1C5AFC94FD923491BD7E05CEE8E956D0~YAAQBCozatRZghGHAQAALXF8MRO408Raj+ej0Y3dnv2tnsie+3e0pxXXVnGPAIrp2YAjaFxPBdXQ6latE1Ump2+x9yK9FHkiV9GQp4R2cvmhJXPXBwrYTObxjdo+kY+ZgrPF+qc/mvKbqtlTSH2TFw/cS7+gf0O1UuDy+uesMbhXCH4TnF4vKDO9fSBlFj2icNckH54eZxVdGhrcgp8LT7UGhHZIHafEyWWSX1V0y1cdql6pCQqdS4jY9+4gVmQh941+Zz4pCtHAAicjlX6VWIXi9RjjDwPAEz1TVFjUAdoK~4404804~3553328; Device=a23a0cdbec1b4b848006b2dc78fdac81'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);



        $tok = json_decode($response);

        //dd($tok);

        $access = $tok->access_token;

        $refresh = $tok->refresh_token;

        return $refresh;
    }
    */
}
