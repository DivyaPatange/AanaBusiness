<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\UserInfo;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\UserOrder;
use App\Models\Admin\UserPayment;
use App\Models\User\UserPlan;

class UserController extends Controller
{
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
        ]);
        if($request->referral_id)
        {
            
            $referralUser = User::where('username', $request->referral_id)->where('status', 'Active')->where('registration_payment', 'Yes')->first();
            if(!empty($referralUser)){
                $userPlan = UserPlan::where('user_id', $referralUser->id)->where('payment_status', 'Successful')->first();
                if(!empty($userPlan)){
                    $users = User::where('parent_id', $referralUser->id)->select('id')->get();
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
                        return redirect()->route('user.payment', $order->id);
                    }
                    else{
                        return Redirect::back()->with('danger', 'You cannot add more than 4 Joiners');
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
            $user->parent_id = 0;
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

            $order = new UserOrder();
            $order->user_id = $id;
            $order->order_number = 'ORD-'.strtoupper(uniqid());
            $order->pay_amount = 100;
            $order->save();
            return redirect()->route('user.payment', $order->id);
        }
        
    }

    public function getPayment($id)
    {
        $order = UserOrder::findorfail($id);
        return view('auth.payment', compact('order'));
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
            'description' => 'Registration Payment',
            'name' => $user->first_name." ".$user->middle_name." ".$user->last_name,
            'email' => $user->email,
            'phone' => $user->mobile_no1,
            'city' => $userInfo->city,
            'country' => 'India', 
            'zip_code' => $userInfo->pincode,
            'return_url' => url('/success') 
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
        // var_dump($request->all());
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
        $user = User::where('id', $order->user_id)->update(['registration_payment' => 'Yes']);
        $paymentDetail = UserPayment::where('id', $payment->id)->first();
        return view('auth.success', compact('paymentDetail'));
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = User::where('username', 'LIKE', $request->referral_id.'%')->where('status', 'Active')
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
                    if($request->referral_id == $row->username){
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

}
