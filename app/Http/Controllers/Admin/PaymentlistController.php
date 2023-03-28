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
/*
   session_start();

   $clientId = '4B5E2A3E9265455C91A676E32AB0ABC1';
   $clientSecret = 'Mm0JUSUgyIIqc8zoKXoe_eC7mpil8tDkOJCJwwjnJdqPSwye';
   $redirectUri = 'https://localhost/ibs/public/admin/payment';
   
   $provider = new \League\OAuth2\Client\Provider\GenericProvider([
       'clientId'                => $clientId,   
       'clientSecret'            => $clientSecret,
       'redirectUri'             => $redirectUri,
       'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
       'urlAccessToken'          => 'https://identity.xero.com/connect/token',
       'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Invoices'
   ]);
   
   // If we don't have an authorization code then get one
   if (!isset($_GET['code'])) {
   
       $options = [
           'scope' => ['openid email profile offline_access accounting.transactions accounting.settings']
       ];
   
       // Fetch the authorization URL from the provider; this returns the
       // urlAuthorize option and generates and applies any necessary parameters (e.g. state).
       $authorizationUrl = $provider->getAuthorizationUrl($options);
   
       // Get the state generated for you and store it to the session.
       $_SESSION['oauth2state'] = $provider->getState();
   
       // Redirect the user to the authorization URL.
       header('Location: ' . $authorizationUrl);
       exit();
   
   // Check given state against previously stored one to mitigate CSRF attack
   } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
       unset($_SESSION['oauth2state']);
       exit('Invalid state');
   
   // Redirect back from Xero with code in query string param
   } else {
   
       try {
           // Try to get an access token using the authorization code grant.
           $accessToken = $provider->getAccessToken('authorization_code', [
               'code' => $_GET['code']
           ]);
   
           // We have an access token, which we may use in authenticated requests 
           // Retrieve the array of connected orgs and their tenant ids.      
           $options['headers']['Accept'] = 'application/json';
           $connectionsResponse = $provider->getAuthenticatedRequest(
               'GET',
               'https://api.xero.com/Connections',
               $accessToken->getToken(),
               $options
           );
   
           $xeroTenantIdArray = $provider->getParsedResponse($connectionsResponse);
           
           echo "<h1>Congrats</h1>";
           echo "access token: " . $accessToken->getToken() . "<hr>";
           echo "refresh token: " . $accessToken->getRefreshToken() . "<hr>";
           echo "xero tenant id: " . $xeroTenantIdArray[0]['tenantId'] . "<hr>";
   
           // The provider provides a way to get an authenticated API request for
           // the service, using the access token; 
           // the xero-tentant-id header is required
           // the accept header can be either 'application/json' or 'application/xml'
           $options['headers']['xero-tenant-id'] = $xeroTenantIdArray[0]['tenantId'];
       $options['headers']['Accept'] = 'application/json';        
           
           $request = $provider->getAuthenticatedRequest(
               'GET',
               'https://api.xero.com/api.xro/2.0/Organisation',
               $accessToken,
               $options
           );
           
       echo 'Organisation details:<br><textarea width: "300px"  height: 150px; row="50" cols="40">';
           var_export($provider->getParsedResponse($request));
           echo '</textarea>';
       } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
           // Failed to get the access token or user details.
           exit($e->getMessage());
       }
    }
    */
   
   // dd($authorizationUrl);
   //die();






$access = 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjFDQUY4RTY2NzcyRDZEQzAyOEQ2NzI2RkQwMjYxNTgxNTcwRUZDMTkiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJISy1PWm5jdGJjQW8xbkp2MENZVmdWY09fQmsifQ.eyJuYmYiOjE2Nzk5OTkzNDAsImV4cCI6MTY4MDAwMTE0MCwiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS54ZXJvLmNvbSIsImF1ZCI6Imh0dHBzOi8vaWRlbnRpdHkueGVyby5jb20vcmVzb3VyY2VzIiwiY2xpZW50X2lkIjoiNEI1RTJBM0U5MjY1NDU1QzkxQTY3NkUzMkFCMEFCQzEiLCJzdWIiOiI2YjZjOGJlMWMwMTg1NTdiYmQ1NWVhNmUwZjZlZGIzYiIsImF1dGhfdGltZSI6MTY3OTk5Njc0MCwieGVyb191c2VyaWQiOiI3Y2M5ZDRjZS1hODJmLTQxMzktODAxYi0yNjZiMzBlZTFiZjAiLCJnbG9iYWxfc2Vzc2lvbl9pZCI6ImJmZDhlZTQyZjBjZDQ2OTJiYTBmODU2OWNmYTcxNjE1Iiwic2lkIjoiYmZkOGVlNDJmMGNkNDY5MmJhMGY4NTY5Y2ZhNzE2MTUiLCJqdGkiOiIwRDFFQ0IwNUUyODAxQ0RDNzY5QjQ3MUIwRjk1OTFCMyIsImF1dGhlbnRpY2F0aW9uX2V2ZW50X2lkIjoiMTdkM2E4NWUtYTliMC00MzYzLWFhMzItOWZlM2RjZGZiZWViIiwic2NvcGUiOlsiZW1haWwiLCJwcm9maWxlIiwib3BlbmlkIiwiYWNjb3VudGluZy5zZXR0aW5ncyIsImFjY291bnRpbmcudHJhbnNhY3Rpb25zIiwiYWNjb3VudGluZy5jb250YWN0cyIsIm9mZmxpbmVfYWNjZXNzIl0sImFtciI6WyJzc28iXX0.d2SNuGWQrWolbfrmdEf-qZeoH0eHu1GFKyD7o4yStv1bF2QG3nNZx-tWISJBwrqnLMfbnZLH1AYQUQsghgZzceDkJUNR7nTyym2IFrDTz-mf5tq_zvo4TQcIds0RqFZhq7m7Tb50qbd3RPZPil3FzXUR5I9DXUd6IMNCdHxgUzWD6SW8qJuYJMGSWclHFe1tvknxmgCwk4CPUOV_bjgoKMSpPV9Y2urbm-BPIL1bJ6iw_OMAaIaI8YadGMMAMdjWSqkZWRoBOPIDYwbzp1xFIHnVg4RwoaB5uPF81DZYqxq3sr4p1y9Rhacl7KIs0RGoFXXK-dt_iw4QV2QY-YBiIA';
       


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
   
               'invoice_sync' => 'yes'
   
           ]);


        dd($update);
   
   
   
           return redirect()->back()->with('success','Invoice synced successfully!');
       }
      else{
   
   
       return redirect()->back()->with('danger','Invoice sync Failed');
   
      }






    

   

      
      

    }
}
