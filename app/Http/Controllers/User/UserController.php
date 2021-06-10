<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\UserPlan;
use App\Models\Admin\UserOrder;
use App\Models\Admin\UserPayment;
use Auth;
use DB;
use App\Models\User;
use App\Models\Admin\UserInfo;
use Illuminate\Support\Facades\Hash;
use Redirect;
use App\Models\User\KycUpload;
use App\Models\User\Income;
use DateTime;
use App\Models\User\UserWallet;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function savePlan(Request $request)
    {
        $plan = new UserPlan();
        $plan->user_id = Auth::user()->id;
        $plan->plan_category = $request->plan;
        $plan->plan_amt = $request->plan_amt;
        $plan->completion_time = $request->completion_time;
        if($request->plan == "Money Plant"){
            $plan->busi_validity = 6;
        }
        else{
            $plan->busi_validity = $request->busi_validity;
        }
        $plan->income_settlement = $request->income_settlement;
        $plan->payment_status = "Pending";
        $plan->save();

        $order = new UserOrder();
        $order->user_id = Auth::user()->id;
        $order->order_number = 'ORD-'.strtoupper(uniqid());
        $order->pay_amount = $request->plan_amt;
        $order->save();
        return redirect()->route('user.plan-payment', $order->id);
    }

    public function planPayment($id)
    {
        $order = UserOrder::findorfail($id);
        return view('user.payment', compact('order'));
    }

    public function payment(Request $request, $id)
    {
        $order = UserOrder::findorfail($id);
        $user = User::where('id', $order->user_id)->first();
        $userInfo = UserInfo::where('user_id', $user->id)->first();
        $salt = 'c9151afd87eb07ae8b51811dfcbe1cfb84a4d581'; //Pass your SALT here

        $data = array(
            'api_key' => '0eb41817-852c-43e9-a9ef-8df89ce1122f',
            'order_id' => $order->order_number,
            'mode' => 'TEST',
            'amount' => $order->pay_amount,
            'currency' => 'INR',
            'description' => 'Plan Payment',
            'name' => $user->first_name." ".$user->middle_name." ".$user->last_name,
            'email' => $user->email,
            'phone' => $user->mobile_no1,
            'city' => $userInfo->city,
            'country' => 'India', 
            'zip_code' => $userInfo->pincode,
            'return_url' => url('/payment-success') 
            );
            $data['hash'] = $this->generateHash($data,$salt);
            $payment_url = 'https://biz.aggrepaypayments.com/v2/paymentrequest';
            ?>
            <html>
            <body OnLoad="OnLoadEvent();">
            <form name="form1" action="<?php echo $payment_url; ?>" method="post">
                <?php foreach ($data as $key => $value) {
                    echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                } ?>
            </form>
            <script language="JavaScript">
                function OnLoadEvent() {
                    document.form1.submit();
                }
            </script>
            </body>
            </html>
            <?php
    }

    public function generateHash($input,$salt)
    {

        /* Columns used for generating the hash value */
        $hash_columns = [
            'address_line_1',
            'address_line_2',
            'amount',
            'api_key',
            'city',
            'country',
            'currency',
            'description',
            'email',
            'mode',
            'name',
            'order_id',
            'phone',
            'return_url',
            'state',
            'udf1',
            'udf2',
            'udf3',
            'udf4',
            'udf5',
            'zip_code',
        ];

        /*Sort the array before hashing*/
        ksort($hash_columns);

        /*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
        $hash_data = $salt;
        foreach ($hash_columns as $column) {
            if (isset($input[$column])) {
                if (strlen($input[$column]) > 0) {
                    $hash_data .= '|' . $input[$column];
                }
            }
        }

        /* Convert the $hash_data to Upper Case and then use SHA512 to generate hash key */
        $hash = null;
        if (strlen($hash_data) > 0) {
            $hash = strtoupper(hash("sha512", $hash_data));
        }

        return $hash;

    }

    public function success(Request $request)
    {
        $order = UserOrder::where('order_number', $request->order_id)->first();
        $payment = new UserPayment();
        $payment->order_id = $order->id;
        $payment->user_id = $order->user_id;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_mode = $request->payment_mode;
        $payment->payment_channel = $request->payment_channel;
        $payment->payment_datetime = $request->payment_datetime;
        $payment->response_message = $request->response_message;
        $payment->save();
        $user_plan = UserPlan::where('user_id', $order->user_id)->update(['payment_status' => 'Successful', 'payment_date' => date("Y-m-d", $request->payment_datetime)]);
        $paymentDetail = UserPayment::where('id', $payment->id)->first();
        return redirect()->route('user.payment-success', $paymentDetail->id);
    }

    public function paymentSuccess($id)
    {
        $paymentDetail = UserPayment::findorfail($id);
        return view('user.success', compact('paymentDetail'));
    }

    public function treeview()
    {
        $users = User::where('parent_id', '=', Auth::user()->id)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->get();
        $authPlan = UserPlan::where('user_id', Auth::user()->id)->where('payment_status', 'Successful')->first();
        // dd($authPlan);
        $allMenus = User::pluck('first_name','id', 'last_name', 'username')->all();
        return view('user.treeview.index',compact('users','allMenus', 'authPlan'));
    }

    public function index()
    {
        $users = DB::table('users')
        ->join('user_infos', 'user_infos.user_id', '=', 'users.id')
        ->join('user_plans', 'user_plans.user_id', '=', 'users.id')
        ->where('parent_id', '=', Auth::user()->id)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->where('user_plans.payment_status', 'Successful')
        ->select('users.*', 'user_infos.address')
        ->get();

        // dd($users);
        if(request()->ajax())
        {
            return datatables()->of($users)
            ->addColumn('full_name', function($row){
                return $row->first_name." ".$row->middle_name." ".$row->last_name;
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.joiners.index');
    }

    public function create()
    {
        return view('user.joiners.create');
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = User::where('username', 'LIKE', $request->reference_id.'%')->where('status', 'Active')
                ->get();
                
        
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            // dd(!(isset($data)) || empty($data));
            if(!(isset($data)) || empty($data))
            {
                return array("error","Please Enter Valid Referral Code");
            }
            if (count($data)>0) {
                // concatenate output to the array
                // loop through the result array
                foreach ($data as $row)
                {
                    if($request->reference_id == $row->username){
                       $output .= $row->first_name.' '.$row->middle_name.' '.$row->last_name;
                    }
                }
                // end of output
            }
            
            else {
                // if there's no matching results according to the input
                $output .= 'No results';
            }
            // return output result array
            return $output;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'mobile_no1' => 'required|digits:10',
            'email' => 'required|email',
            'dob' => 'required',
            'blood_group' => 'required',
            'promoter_name' => 'required',
            'promoter_mobile' => 'required',
            'address' => 'required',
            'password' => 'required|min:8',
            'payment_mode' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'reference_id' => 'required',
        ]);
        if($request->reference_id)
        {
            
            $referralUser = User::where('username', $request->reference_id)->where('status', 'Active')->first();
            if(!empty($referralUser)){
                $userPlan = UserPlan::where('user_id', $referralUser->id)->where('payment_status', 'Successful')->first();
                if(!empty($userPlan)){
                    $users = User::where('parent_id', $referralUser->id)->select('id')->get();
                    if($userPlan->plan_category != "Money Plant"){
                        if(count($users) < 4)
                        {
                            $id = mt_rand(10000000,99999999);
                            $user = new User();
                            $user->id = $id;
                            $user->first_name = $request->first_name;
                            $user->middle_name = $request->middle_name;
                            $user->last_name = $request->last_name;
                            $user->username = $request->username;
                            $user->password = Hash::make($request->password);
                            $user->show_password = $request->password;
                            $user->mobile_no1 = $request->mobile_no1;
                            $user->mobile_no2 = $request->mobile_no2;
                            $user->land_line = $request->land_line;
                            $user->parent_id = $referralUser->id;
                            $user->email = $request->email;
                            $user->save();
    
                            $userInfo = new UserInfo();
                            $userInfo->user_id = $id;
                            $userInfo->dob = $request->dob;
                            $userInfo->blood_group = $request->blood_group;
                            $userInfo->promoter_name = $request->promoter_name;
                            $userInfo->promoter_mobile = $request->promoter_mobile;
                            $userInfo->address = $request->address;
                            $userInfo->payment_mode = $request->payment_mode;
                            $userInfo->city = $request->city;
                            $userInfo->pincode = $request->pincode;
                            $image = $request->file('photo');
                            if($image){
                            $image_name = rand() . '.' . $image->getClientOriginalExtension();
                            // $cvrimage->storeAs('public/tempcourseimg',$image_name);
                            $image->move(public_path('UserPhoto'), $image_name);
                            $userInfo->photo = $image_name;
                            }
                            $userInfo->save();
    
                            $plan = new UserPlan();
                            $plan->user_id = $id;
                            $plan->plan_category = $userPlan->plan_category;
                            $plan->plan_amt = $userPlan->plan_amt;
                            $plan->completion_time = $userPlan->completion_time;
                            $plan->busi_validity = $userPlan->busi_validity;
                            $plan->payment_status = "Pending";
                            $plan->save();
                            $planOrder = new UserOrder();
                            $planOrder->user_id = $id;
                            $planOrder->order_number = 'ORD-'.strtoupper(uniqid());
                            $planOrder->pay_amount = $plan->plan_amt;
                            $planOrder->save();
    
                            $order = new UserOrder();
                            $order->user_id = $id;
                            $order->order_number = 'ORD-'.strtoupper(uniqid());
                            $order->pay_amount = 100;
                            $order->save();
                            
                            return redirect()->route('user.registration-payment', $order->id);
                        }
                        else{
                            return Redirect::back()->with('danger', 'You cannot add more than 4 Joiners');
                        }
                    }
                    else{
                        $id = mt_rand(10000000,99999999);
                        $user = new User();
                        $user->id = $id;
                        $user->first_name = $request->first_name;
                        $user->middle_name = $request->middle_name;
                        $user->last_name = $request->last_name;
                        $user->username = $request->username;
                        $user->password = Hash::make($request->password);
                        $user->show_password = $request->password;
                        $user->mobile_no1 = $request->mobile_no1;
                        $user->mobile_no2 = $request->mobile_no2;
                        $user->land_line = $request->land_line;
                        $user->parent_id = $referralUser->id;
                        $user->email = $request->email;
                        $user->save();

                        $userInfo = new UserInfo();
                        $userInfo->user_id = $id;
                        $userInfo->dob = $request->dob;
                        $userInfo->blood_group = $request->blood_group;
                        $userInfo->promoter_name = $request->promoter_name;
                        $userInfo->promoter_mobile = $request->promoter_mobile;
                        $userInfo->address = $request->address;
                        $userInfo->payment_mode = $request->payment_mode;
                        $userInfo->city = $request->city;
                        $userInfo->pincode = $request->pincode;
                        $image = $request->file('photo');
                        if($image){
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        // $cvrimage->storeAs('public/tempcourseimg',$image_name);
                        $image->move(public_path('UserPhoto'), $image_name);
                        $userInfo->photo = $image_name;
                        }
                        $userInfo->save();

                        $plan = new UserPlan();
                        $plan->user_id = $id;
                        $plan->plan_category = $userPlan->plan_category;
                        $plan->plan_amt = $userPlan->plan_amt;
                        $plan->completion_time = $userPlan->completion_time;
                        $plan->busi_validity = $userPlan->busi_validity;
                        $plan->payment_status = "Pending";
                        $plan->save();
                        $planOrder = new UserOrder();
                        $planOrder->user_id = $id;
                        $planOrder->order_number = 'ORD-'.strtoupper(uniqid());
                        $planOrder->pay_amount = $plan->plan_amt;
                        $planOrder->save();

                        $order = new UserOrder();
                        $order->user_id = $id;
                        $order->order_number = 'ORD-'.strtoupper(uniqid());
                        $order->pay_amount = 100;
                        $order->save();
                        
                        return redirect()->route('user.registration-payment', $order->id);
                    }
                }
                else{
                    return Redirect::back()->with('danger', 'Reference User not selected plan!');
                }
            }
            else{
                return Redirect::back()->with('danger', 'Reference User Not Found!');
            }
        }
    }
    
    public function sendSms($message,$number)
    {
        $url = 'http://sms.bulksmsind.in/v2/sendSMS?username=iceico&message='.$message.'&sendername=ANABUS&smstype=TRANS&numbers='.$number.'&apikey=24ae8ae0-b514-499b-8baf-51d55808a2c4&peid=1201161959563006533&templateid=1207162135988607166';
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

    public function registrationPayment($id)
    {
        $order = UserOrder::findorfail($id);
        return view('user.regi_payment', compact('order'));
    }

    public function registrationPay(Request $request, $id)
    {
        $order = UserOrder::findorfail($id);
        $user = User::where('id', $order->user_id)->first();
        $userInfo = UserInfo::where('user_id', $user->id)->first();
        $salt = 'c9151afd87eb07ae8b51811dfcbe1cfb84a4d581'; //Pass your SALT here

        $data = array(
            'api_key' => '0eb41817-852c-43e9-a9ef-8df89ce1122f',
            'order_id' => $order->order_number,
            'mode' => 'TEST',
            'amount' => $order->pay_amount,
            'currency' => 'INR',
            'description' => 'Registration Payment',
            'name' => $user->first_name." ".$user->middle_name." ".$user->last_name,
            'email' => $user->email,
            'phone' => $user->mobile_no1,
            'city' => $userInfo->city,
            'country' => 'India', 
            'zip_code' => $userInfo->pincode,
            'return_url' => url('/user/payment-success') 
            );
            $data['hash'] = $this->generateHash($data,$salt);
            $payment_url = 'https://biz.aggrepaypayments.com/v2/paymentrequest';
            ?>
            <html>
            <body OnLoad="OnLoadEvent();">
            <form name="form1" action="<?php echo $payment_url; ?>" method="post">
                <?php foreach ($data as $key => $value) {
                    echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                } ?>
            </form>
            <script language="JavaScript">
                function OnLoadEvent() {
                    document.form1.submit();
                }
            </script>
            </body>
            </html>
            <?php
    }

    public function registrationSuccess(Request $request)
    {
        $order = UserOrder::where('order_number', $request->order_id)->first();
        $payment = new UserPayment();
        $payment->order_id = $order->id;
        $payment->user_id = $order->user_id;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_mode = $request->payment_mode;
        $payment->payment_channel = $request->payment_channel;
        $payment->payment_datetime = $request->payment_datetime;
        $payment->response_message = $request->response_message;
        $payment->save();
        $result = User::where('id', $order->user_id)->update(['registration_payment' => 'Yes']);
        
        $user = User::where('id', $order->user_id)->first();
        $message = "Hello+".urlencode($user->first_name.' '.$user->last_name)."%0aWelcome+to+Aana+Business+"."%0aYour+Login+credentials+are+as+follows:%0aUsername:-+".$user->username."%0aPassword:-+".$user->show_password."%0aRegards,+Aana+Business";
                
        $number = $user->mobile_no1;
        $this->sendSms($message,$number);
        $paymentDetail = UserPayment::where('id', $payment->id)->first();
        return redirect()->route('user.payment-success', $paymentDetail->id);
    }

    public function planDetails()
    {
        return view('user.plan-detail');
    }
    
    public function kycUpload()
    {
        $kycDetails = KycUpload::where('user_id', Auth::user()->id)->first();
        return view('user.kyc-upload', compact('kycDetails'));
    }

    public function uploadDocument(Request $request)
    {
        $kycDetails = KycUpload::where('user_id', Auth::user()->id)->first();
        if(empty($kycDetails))
        {
            if($request->pan_img != ''){        
                $path = public_path().'/kycdocument/pan/';
      
                //upload new file
                $file = $request->pan_img;
                $filename = $file->getClientOriginalName();
                $file->move($path, $filename);
           }
           else{
               $filename = Null;
           }
           if($request->aadhar_img != ''){        
                $path1 = public_path().'/kycdocument/aadhar/';
    
                //upload new file
                $file1 = $request->aadhar_img;
                $filename1 = $file1->getClientOriginalName();
                $file1->move($path1, $filename1);
            }
            else{
                $filename1 = Null;
            }
            if($request->user_img != ''){        
                $path2 = public_path().'/kycdocument/user/';
        
                //upload new file
                $file2 = $request->user_img;
                $filename2 = $file2->getClientOriginalName();
                $file2->move($path2, $filename2);
            }
            else{
                $filename2 = Null;
            }
            $upload = new KycUpload();
            $upload->user_id = Auth::user()->id;
            $upload->pan_img = $filename;
            $upload->aadhar_img = $filename1;
            $upload->user_img = $filename2;
            $upload->save();
        }
        else{
            if($request->pan_img != ''){        
                $path = public_path().'/kycdocument/pan/';
      
                //upload new file
                $file = $request->pan_img;
                $filename = $file->getClientOriginalName();
                $file->move($path, $filename);
      
                //for update in table
                $kycDetails->update(['pan_img' => $filename]);
           }
    
           if($request->aadhar_img != ''){        
                $path1 = public_path().'/kycdocument/aadhar/';
    
                //upload new file
                $file1 = $request->aadhar_img;
                $filename1 = $file1->getClientOriginalName();
                $file1->move($path1, $filename1);
    
                //for update in table
                $kycDetails->update(['aadhar_img' => $filename1]);
            }
    
            if($request->user_img != ''){        
                $path2 = public_path().'/kycdocument/user/';
        
                //upload new file
                $file2 = $request->user_img;
                $filename2 = $file2->getClientOriginalName();
                $file2->move($path2, $filename2);
        
                //for update in table
                $kycDetails->update(['user_img' => $filename2]);
            }
        }
        return redirect('/user/kyc-upload')->with('success', 'Document Uploaded Successfully!');
    }

    public function myProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        return view('user.profile', compact('user', 'userInfo'));
    }

    public function editProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        return view('user.edit-profile', compact('user', 'userInfo'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'mobile_no1' => 'required|digits:10',
            'email' => 'required|email',
            'dob' => 'required',
            'blood_group' => 'required',
            'promoter_name' => 'required',
            'promoter_mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);
        $user = User::findorfail($id);
        $userInfo = UserInfo::where('user_id', $id)->first();
        $image_name = $request->hidden_image;
        $image = $request->file('photo');
        if($image != '')
        {
            if($userInfo->photo)
            {
                unlink(public_path('UserPhoto/'.$userInfo->photo));
            }
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image->move(public_path('UserPhoto'), $image_name);
        }
        $input_data = array (
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'mobile_no1' => $request->mobile_no1,
            'mobile_no2' => $request->mobile_no2,
            'land_line' => $request->land_line,
            'email' => $request->email,
        );
        $input_data1 = array (
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'promoter_name' => $request->promoter_name,
            'promoter_mobile' => $request->promoter_mobile,
            'address' => $request->address,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'photo' => $image_name,
        );
        User::whereId($id)->update($input_data);
        UserInfo::whereId($userInfo->id)->update($input_data1);
        return redirect('/user/my-profile')->with('success', 'Profile Updated Successfully!');
    }

    public function wallet()
    {
        $users = User::where('parent_id', '=', Auth::user()->id)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->get();
        $plan = UserPlan::where('user_id', Auth::user()->id)->first();
        if(!empty($plan)){
            $order = UserOrder::where('user_id', Auth::user()->id)->where('pay_amount', $plan->plan_amt)->first();
            $payment = UserPayment::where('order_id', $order->id)->first();
            $paymentDate = new DateTime($payment->payment_datetime);
            $converted_at = $paymentDate->format('Y-m-d');
            $dt = strtotime($converted_at);
            $busiValidity = $plan->busi_validity." months";
            $extendedDate = date("Y-m-d", strtotime($busiValidity , $dt));
        }
        $incomelevel1 = Income::where('user_id', Auth::user()->id)->where('level', 1)->get();
        $incomelevel2 = Income::where('user_id', Auth::user()->id)->where('level', 2)->get();
        $incomelevel3 = Income::where('user_id', Auth::user()->id)->where('level', 3)->get();
        $incomelevel4 = Income::where('user_id', Auth::user()->id)->where('level', 4)->get();
        $incomelevel5 = Income::where('user_id', Auth::user()->id)->where('level', 5)->get();
        $incomelevel6 = Income::where('user_id', Auth::user()->id)->where('level', 6)->get();
        $incomelevel7 = Income::where('user_id', Auth::user()->id)->where('level', 7)->get();
        if(count($incomelevel1) == 4)
        {
            $items8 = array();
            foreach($incomelevel1 as $i1)
            {
                $items8[] = $i1->payment_date;
            }
            $payment_dt = new Datetime(max($items8));
            $payment_converted_at = $payment_dt->format('Y-m-d');
            $amount1 = $incomelevel1->sum('income_amount');
            $userWallet1 = UserWallet::where('user_id', Auth::user()->id)->where('level', 1)->first();
            if(empty($userWallet1))
            {
                if (($payment_converted_at >= $converted_at) && ($payment_converted_at <= $extendedDate)){
                    $wallet1 = new UserWallet();
                    $wallet1->user_id = Auth::user()->id;
                    $wallet1->level = 1;
                    $wallet1->wallet_amt = $amount1;
                    $wallet1->income_date = max($items8);
                    $wallet1->save();
                }
            }
        }
        if(count($incomelevel2) == 16)
        {
            $items9 = array();
            foreach($incomelevel2 as $i2)
            {
                $items9[] = $i2->payment_date;
            }
            $payment_dt1 = new Datetime(max($items9));
            $payment_converted_at1 = $payment_dt1->format('Y-m-d');
            $amount2 = $incomelevel2->sum('income_amount');
            $userWallet2 = UserWallet::where('user_id', Auth::user()->id)->where('level', 2)->first();
            if(empty($userWallet2))
            {
                if (($payment_converted_at1 >= $converted_at) && ($payment_converted_at1 <= $extendedDate)){
                    $wallet2 = new UserWallet();
                    $wallet2->user_id = Auth::user()->id;
                    $wallet2->level = 2;
                    $wallet2->wallet_amt = $amount2;
                    $wallet2->income_date = max($items9);
                    $wallet2->save();
                }
            }
        }
        if(count($incomelevel3) == 64)
        {
            $items10 = array();
            foreach($incomelevel3 as $i3)
            {
                $items10[] = $i3->payment_date;
            }
            $payment_dt2 = new Datetime(max($items10));
            $payment_converted_at2 = $payment_dt2->format('Y-m-d');
            $amount3 = $incomelevel3->sum('income_amount');
            $userWallet3 = UserWallet::where('user_id', Auth::user()->id)->where('level', 3)->first();
            if(empty($userWallet3))
            {
                if (($payment_converted_at2 >= $converted_at) && ($payment_converted_at2 <= $extendedDate)){
                    $wallet3 = new UserWallet();
                    $wallet3->user_id = Auth::user()->id;
                    $wallet3->level = 3;
                    $wallet3->wallet_amt = $amount3;
                    $wallet3->income_date = max($items10);
                    $wallet3->save();
                }
            }
        }
        if(count($incomelevel4) == 256)
        {
            $items11 = array();
            foreach($incomelevel4 as $i4)
            {
                $items11[] = $i4->payment_date;
            }
            $payment_dt3 = new Datetime(max($items11));
            $payment_converted_at3 = $payment_dt3->format('Y-m-d');
            $amount4 = $incomelevel4->sum('income_amount');
            $userWallet4 = UserWallet::where('user_id', Auth::user()->id)->where('level', 4)->first();
            if(empty($userWallet4))
            {
                if (($payment_converted_at3 >= $converted_at) && ($payment_converted_at3 <= $extendedDate)){
                    $wallet4 = new UserWallet();
                    $wallet4->user_id = Auth::user()->id;
                    $wallet4->level = 4;
                    $wallet4->wallet_amt = $amount4;
                    $wallet4->income_date = max($items11);
                    $wallet4->save();
                }
            }
        }
        if(count($incomelevel5) == 1024)
        {
            $items12 = array();
            foreach($incomelevel5 as $i5)
            {
                $items12[] = $i5->payment_date;
            }
            $payment_dt4 = new Datetime(max($items12));
            $payment_converted_at4 = $payment_dt4->format('Y-m-d');
            $amount5 = $incomelevel5->sum('income_amount');
            $userWallet5 = UserWallet::where('user_id', Auth::user()->id)->where('level', 5)->first();
            if(empty($userWallet5))
            {
                if (($payment_converted_at4 >= $converted_at) && ($payment_converted_at4 <= $extendedDate)){
                    $wallet5 = new UserWallet();
                    $wallet5->user_id = Auth::user()->id;
                    $wallet5->level = 5;
                    $wallet5->wallet_amt = $amount5;
                    $wallet5->income_date = max($items12);
                    $wallet5->save();
                }
            }
        }
        if(count($incomelevel6) == 4096)
        {
            $items13 = array();
            foreach($incomelevel6 as $i6)
            {
                $items13[] = $i6->payment_date;
            }
            $payment_dt5 = new Datetime(max($items13));
            $payment_converted_at5 = $payment_dt5->format('Y-m-d');
            $amount6 = $incomelevel6->sum('income_amount');
            $userWallet6 = UserWallet::where('user_id', Auth::user()->id)->where('level', 6)->first();
            if(empty($userWallet6))
            {
                if (($payment_converted_at5 >= $converted_at) && ($payment_converted_at5 <= $extendedDate)){
                    $wallet6 = new UserWallet();
                    $wallet6->user_id = Auth::user()->id;
                    $wallet6->level = 6;
                    $wallet6->wallet_amt = $amount6;
                    $wallet6->income_date = max($items13);
                    $wallet6->save();
                }
            }
        }
        if(count($incomelevel7) == 16384)
        {
            $items14 = array();
            foreach($incomelevel7 as $i7)
            {
                $items14[] = $i7->payment_date;
            }
            $payment_dt6 = new Datetime(max($items14));
            $payment_converted_at6 = $payment_dt6->format('Y-m-d');
            $amount7 = $incomelevel7->sum('income_amount');
            $userWallet7 = UserWallet::where('user_id', Auth::user()->id)->where('level', 7)->first();
            if(empty($userWallet7))
            {
                if (($payment_converted_at6 >= $converted_at) && ($payment_converted_at6 <= $extendedDate)){
                    $wallet7 = new UserWallet();
                    $wallet7->user_id = Auth::user()->id;
                    $wallet7->level = 7;
                    $wallet7->wallet_amt = $amount7;
                    $wallet7->income_date = max($items14);
                    $wallet7->save();
                }
            }
        }
        $items = array();
        $items1 = array();
        $items2 = array();
        $items3 = array();
        $items4 = array();
        $items5 = array();
        $items6 = array();
        $items7 = array();
        foreach($users as $user)
        {
            $leveluserPlan = UserPlan::where('user_id', $user->id)->where('payment_status', 'Successful')->first();
            $items[] = $leveluserPlan;
            foreach($user->childs as $child)
            {
                $leveluserPlan1 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                $items2[] = $leveluserPlan1;
                foreach($child->childs as $child)
                {
                    $leveluserPlan2 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                    $items3[] = $leveluserPlan2;
                    foreach($child->childs as $child)
                    {
                        $leveluserPlan3 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                        $items4[] = $leveluserPlan3;
                        foreach($child->childs as $child)
                        {
                            $leveluserPlan4 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                            $items5[] = $leveluserPlan4;
                            foreach($child->childs as $child)
                            {
                                $leveluserPlan5 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                                $items6[] = $leveluserPlan5;
                                foreach($child->childs as $child)
                                {
                                    $leveluserPlan6 = UserPlan::where('user_id', $child->id)->where('payment_status', 'Successful')->first();
                                    $items7[] = $leveluserPlan6;
                                }
                            }
                        }
                    }
                }
            }
        }
        $wallet = UserWallet::where('user_id', Auth::user()->id)->get();
        $allMenus = User::pluck('first_name','id', 'last_name', 'username')->all();
        return view('user.wallet.index', compact('users', 'allMenus', 'wallet', 'items2', 'items3', 'items4', 'items5', 'items6', 'items7', 'plan'));
    }

}
