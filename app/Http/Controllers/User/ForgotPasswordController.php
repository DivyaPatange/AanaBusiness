<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Log;
use Auth;
use Route;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);
        $username = $request->username;
        $user = User::where('username',$username)->first();
        $id = $user->id;
        if(!empty($username) && isset($id))
        {
            $newpassword = str_random(10);
            $result = User::where('id',$id)->update(['password' => Hash::make($newpassword), 'show_password' => $newpassword]);
            if($result)
            {
                $message = "Hello+".urlencode($user->first_name)."%0aYour+password+has+been+reset+and+your+new+crendentials+are.%0aUsername:+".$request->username."%0aPassword:+".$newpassword."%0aYou+can+login+to+your+distributer+account+here%0ahttp://shop.marketdrushti.com/login/";
              
                $number = $user->mobile_no1;
               
                $this->sendMessage($message,$number);
                // dd($this->sendMessage($message,$number));
                
               return redirect('/login')->with('user', $user)->with('success', 'Password has been reset successfully!');
            }
            else
            {
                return array("error","Sorry Unable to Reset Password at this Moment !");
            }
        }
        else
        {
            return array("error","Sorry ! No Distributer Found with that username");
        }
    }

    public function sendMessage($message,$number)
    {
        $url = 'http://sms.bulksmsind.in/v2/sendSMS?username=iceico&message='.$message.'&sendername=ICEICO&smstype=TRANS&numbers='.$number.'&apikey=24ae8ae0-b514-499b-8baf-51d55808a2c4&peid=1201159289080968812&templateid=1207161962048268307';

        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
    	// curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	
    	curl_setopt($ch,CURLOPT_HEADER, false);
     
        $output=curl_exec($ch);
     
        curl_close($ch);
       
        return $output;
    }
}
