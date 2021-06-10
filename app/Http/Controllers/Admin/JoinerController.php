<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Admin\UserInfo;
use App\Models\Admin\UserOrder;
use App\Models\Admin\UserPayment;
use Illuminate\Support\Facades\Hash;
use Redirect;
use App\Models\User\UserPlan;
use App\Models\User\Income;
use App\Models\User\JoinerLevel;
use DateTime;
use App\Models\User\UserWallet;
use App\Models\Admin\Settlement;
use App\Models\Admin\PaymentSettlement;

class JoinerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
        ->join('user_infos', 'user_infos.user_id', '=', 'users.id')
        ->join('user_plans', 'user_plans.user_id', '=', 'users.id')
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->where('user_plans.payment_status', 'Successful')
        ->select('users.*', 'user_infos.address')
        ->get();

        // dd($users);
        if(request()->ajax())
        {
            return datatables()->of($users)
            ->addColumn('fullname', function($row){
                return $row->first_name." ".$row->middle_name." ".$row->last_name;
            })
            ->addColumn('action', 'admin.joiners.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.joiners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.joiners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('admin.payment', $order->id);
    }
    
    public function sendSms($message,$number)
    {
        $url = 'http://sms.bulksmsind.in/v2/sendSMS?username=iceico&message='.$message.'&sendername=ICEICO&smstype=TRANS&numbers='.$number.'&apikey=24ae8ae0-b514-499b-8baf-51d55808a2c4&peid=1201161959563006533&templateid=1207162135988607166';
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('parent_id', '=', $id)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->get();
        $allMenus = User::pluck('first_name','id', 'last_name', 'username')->all();
        $userProfile = User::findorfail($id);
        $userInfo = UserInfo::where('user_id', $id)->first();
        $userPlan = UserPlan::where('user_id', $id)->first();
        $userOrder = UserOrder::where('user_id', $id)->where('pay_amount', $userPlan->plan_amt)->first();
        $userPayment = UserPayment::where('order_id', $userOrder->id)->first();
        // dd($userPayment);
        if(!empty($userPlan)){
            $userOrder = UserOrder::where('user_id', $id)->where('pay_amount', $userPlan->plan_amt)->first();
            $userPayment = UserPayment::where('order_id', $userOrder->id)->first();
            // $order = UserOrder::where('user_id', Auth::user()->id)->where('pay_amount', $userPlan->plan_amt)->first();
            // $payment = UserPayment::where('order_id', $order->id)->first();
            $paymentDate = new DateTime($userPayment->payment_datetime);
            $converted_at = $paymentDate->format('Y-m-d');
            $dt = strtotime($converted_at);
            $busiValidity = $userPlan->busi_validity." months";
            $extendedDate = date("Y-m-d", strtotime($busiValidity , $dt));
        }
        $incomelevel1 = Income::where('user_id', $id)->where('level', 1)->get();
        $incomelevel2 = Income::where('user_id', $id)->where('level', 2)->get();
        $incomelevel3 = Income::where('user_id', $id)->where('level', 3)->get();
        $incomelevel4 = Income::where('user_id', $id)->where('level', 4)->get();
        $incomelevel5 = Income::where('user_id', $id)->where('level', 5)->get();
        $incomelevel6 = Income::where('user_id', $id)->where('level', 6)->get();
        $incomelevel7 = Income::where('user_id', $id)->where('level', 7)->get();
        if(count($incomelevel1) == 4)
        {
            $items1 = array();
            foreach($incomelevel1 as $i1)
            {
                $items1[] = $i1->payment_date;
            }
            $payment_dt = new Datetime(max($items1));
            $payment_converted_at = $payment_dt->format('Y-m-d');
            $amount1 = $incomelevel1->sum('income_amount');
            $userWallet1 = UserWallet::where('user_id', $id)->where('level', 1)->first();
            if(empty($userWallet1))
            {
                if (($payment_converted_at >= $converted_at) && ($payment_converted_at <= $extendedDate)){
                    $wallet1 = new UserWallet();
                    $wallet1->user_id = $id;
                    $wallet1->level = 1;
                    $wallet1->wallet_amt = $amount1;
                    $wallet1->income_date = max($items1);
                    $wallet1->save();
                }
            }
        }
        if(count($incomelevel2) == 16)
        {
            $items2 = array();
            foreach($incomelevel2 as $i2)
            {
                $items2[] = $i2->payment_date;
            }
            $payment_dt1 = new Datetime(max($items2));
            $payment_converted_at1 = $payment_dt1->format('Y-m-d');
            $amount2 = $incomelevel2->sum('income_amount');
            $userWallet2 = UserWallet::where('user_id', $id)->where('level', 2)->first();
            if(empty($userWallet2))
            {
                if (($payment_converted_at1 >= $converted_at) && ($payment_converted_at1 <= $extendedDate)){
                    $wallet2 = new UserWallet();
                    $wallet2->user_id = $id;
                    $wallet2->level = 2;
                    $wallet2->wallet_amt = $amount2;
                    $wallet2->income_date = max($items2);
                    $wallet2->save();
                }
            }
        }
        if(count($incomelevel3) == 64)
        {
            $items3 = array();
            foreach($incomelevel3 as $i3)
            {
                $items3[] = $i3->payment_date;
            }
            $payment_dt2 = new Datetime(max($items3));
            $payment_converted_at2 = $payment_dt2->format('Y-m-d');
            $amount3 = $incomelevel3->sum('income_amount');
            $userWallet3 = UserWallet::where('user_id', $id)->where('level', 3)->first();
            if(empty($userWallet3))
            {
                if (($payment_converted_at2 >= $converted_at) && ($payment_converted_at2 <= $extendedDate)){
                    $wallet3 = new UserWallet();
                    $wallet3->user_id = $id;
                    $wallet3->level = 3;
                    $wallet3->wallet_amt = $amount3;
                    $wallet3->income_date = max($items3);
                    $wallet3->save();
                }
            }
        }
        if(count($incomelevel4) == 256)
        {
            $items4 = array();
            foreach($incomelevel4 as $i4)
            {
                $items4[] = $i4->payment_date;
            }
            $payment_dt3 = new Datetime(max($items4));
            $payment_converted_at3 = $payment_dt3->format('Y-m-d');
            $amount4 = $incomelevel4->sum('income_amount');
            $userWallet4 = UserWallet::where('user_id', $id)->where('level', 4)->first();
            if(empty($userWallet4))
            {
                if (($payment_converted_at3 >= $converted_at) && ($payment_converted_at3 <= $extendedDate)){
                    $wallet4 = new UserWallet();
                    $wallet4->user_id = $id;
                    $wallet4->level = 4;
                    $wallet4->wallet_amt = $amount4;
                    $wallet4->income_date = max($items4);
                    $wallet4->save();
                }
            }
        }
        if(count($incomelevel5) == 1024)
        {
            $items5 = array();
            foreach($incomelevel5 as $i5)
            {
                $items5[] = $i5->payment_date;
            }
            $payment_dt4 = new Datetime(max($items5));
            $payment_converted_at4 = $payment_dt4->format('Y-m-d');
            $amount5 = $incomelevel5->sum('income_amount');
            $userWallet5 = UserWallet::where('user_id', $id)->where('level', 5)->first();
            if(empty($userWallet5))
            {
                if (($payment_converted_at4 >= $converted_at) && ($payment_converted_at4 <= $extendedDate)){
                    $wallet5 = new UserWallet();
                    $wallet5->user_id = $id;
                    $wallet5->level = 5;
                    $wallet5->wallet_amt = $amount5;
                    $wallet5->income_date = max($items5);
                    $wallet5->save();
                }
            }
        }
        if(count($incomelevel6) == 4096)
        {
            $items6 = array();
            foreach($incomelevel6 as $i6)
            {
                $items6[] = $i6->payment_date;
            }
            $payment_dt5 = new Datetime(max($items6));
            $payment_converted_at5 = $payment_dt5->format('Y-m-d');
            $amount6 = $incomelevel6->sum('income_amount');
            $userWallet6 = UserWallet::where('user_id', $id)->where('level', 6)->first();
            if(empty($userWallet6))
            {
                if (($payment_converted_at5 >= $converted_at) && ($payment_converted_at5 <= $extendedDate)){
                    $wallet6 = new UserWallet();
                    $wallet6->user_id = $id;
                    $wallet6->level = 6;
                    $wallet6->wallet_amt = $amount6;
                    $wallet6->income_date = max($items6);
                    $wallet6->save();
                }
            }
        }
        if(count($incomelevel7) == 16384)
        {
            $items7 = array();
            foreach($incomelevel7 as $i7)
            {
                $items7[] = $i7->payment_date;
            }
            $payment_dt6 = new Datetime(max($items7));
            $payment_converted_at6 = $payment_dt6->format('Y-m-d');
            $amount7 = $incomelevel7->sum('income_amount');
            $userWallet7 = UserWallet::where('user_id', $id)->where('level', 7)->first();
            if(empty($userWallet7))
            {
                if (($payment_converted_at6 >= $converted_at) && ($payment_converted_at6 <= $extendedDate)){
                    $wallet7 = new UserWallet();
                    $wallet7->user_id = $id;
                    $wallet7->level = 7;
                    $wallet7->wallet_amt = $amount7;
                    $wallet7->income_date = max($items7);
                    $wallet7->save();
                }
            }
        }
        $wallet = UserWallet::where('user_id', $id)->get();
        $joinerLevel1 = JoinerLevel::where('user_id', $id)->where('level', 1)->first();
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
        if(!empty($joinerLevel1))
        {
            if(count($items) == 4)
            {
                if(!in_array(null, $items))
                {
                    foreach($items as $i)
                    {
                        $orderDetails = DB::table('user_orders')->where('user_id', $i->user_id)->where('pay_amount', $i->plan_amt)->first();
                        $orderPayment = DB::table('user_payments')->where('order_id', $orderDetails->id)->first();
                        $items1[] = $orderPayment->payment_datetime;
                    }
                    // dd(max($items1));
                    $parentUserPlan = UserPlan::where('user_id', $id)->first();
                    if(!empty($parentUserPlan)){
                        $userOrder = DB::table('user_orders')->where('user_id', $parentUserPlan->user_id)->where('pay_amount', $parentUserPlan->plan_amt)->first();
                        $userPayment = DB::table('user_payments')->where('order_id', $userOrder->id)->where('user_id', $id)->first();
                        $paymentDate = new DateTime($userPayment->payment_datetime);
                        $converted_at = $paymentDate->format('Y-m-d');
                        $dt = strtotime($converted_at);
                        $completionTime = $parentUserPlan->completion_time." day";
                        $extendedDate = date("Y-m-d", strtotime($completionTime , $dt));
                        $payment_dt = new Datetime(max($items1));
                        $payment_converted_at = $payment_dt->format('Y-m-d');
                        if (($payment_converted_at >= $converted_at) && ($payment_converted_at <= $payment_converted_at)){ 
                            $updateLevel = JoinerLevel::where('user_id', $id)->where('level', 1)->update(['status' => 1]);
                        }  
                        else{
                            $userStatus = User::where('id', $id)->update(['status' => 'Deactive']);
                        }
                    }
                }
            }
        }
        else{
            $joinerLevel1 = new JoinerLevel();
            $joinerLevel1->user_id = $id;
            $joinerLevel1->level = 1;
            $joinerLevel1->total_joiner = 4;
            $joinerLevel1->joiner_added = count($users);
            $joinerLevel1->save();
        }
        return view('admin.joiners.show', compact('userProfile', 'userPlan', 'userInfo', 'userOrder', 'userPayment', 'users', 'allMenus', 'joinerLevel1', 'wallet', 'items2', 'items3', 'items4', 'items5', 'items6', 'items7'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        $userInfo = UserInfo::where('user_id', $id)->first();
        return view('admin.joiners.edit', compact('user', 'userInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        return redirect('/admin/joiners')->with('success', 'Joiner Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPayment($id)
    {
        $order = UserOrder::findorfail($id);
        return view('admin.payment', compact('order'));
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
            'return_url' => url('/admin/success') 
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
        $result = User::where('id', $order->user_id)->update(['registration_payment' => 'Yes']);
        
        $user = User::where('id', $order->user_id)->first();
        $message = "Hello+".urlencode($user->first_name.' '.$user->last_name)."%0aWelcome+to+Aana+Business+"."%0aYour+Login+credentials+are+as+follows:%0aUsername:-+".$user->username."%0aPassword:-+".$user->show_password."%0aRegards,+Aana+Business";
                
        $number = $user->mobile_no1;
        $this->sendSms($message,$number);
        $paymentDetail = UserPayment::where('id', $payment->id)->first();
        return redirect()->route('admin.payment-success', $paymentDetail->id);
    }

    public function paymentSuccess($id)
    {
        $paymentDetail = UserPayment::findorfail($id);
        return view('admin.success', compact('paymentDetail'));
    }

    public function treeview()
    {
        $users = User::where('parent_id', '=', 0)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->get();
        $allMenus = User::pluck('first_name','id', 'last_name', 'username')->all();
        return view('admin.treeview.index',compact('users','allMenus'));
    }

    public function paymentSettlement()
    {
        $settlement = Settlement::all();
        if(request()->ajax())
        {
            return datatables()->of($settlement)
            ->addColumn('month', function($row){
                $month = date('F', mktime(0,0,0,$row->month, 1, date('Y')));
                return $month;
            })
            ->addColumn('action', function($row){
                $route = route('admin.payment-settlement.view', $row->id);
                return '<a href="'.$route.'"><button type="button" class="btn btn-primary">View</button></a>';
            })
            ->rawColumns(['start_date', 'end_date', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment-settlement.index');
    }
    
    public function generatePaymentSettlement(Request $request)
    {
        $users = DB::table('users')->where('status', 'Active')->where('registration_payment', 'Yes')->join('user_plans', 'user_plans.user_id', '=', 'users.id')->select('users.*', 'user_plans.plan_category', 'user_plans.plan_amt', 'user_plans.plan_category', 'user_plans.income_settlement', 'user_plans.payment_status')->where('payment_status', 'Successful')->where('plan_category', 'Money Plant')->get();
        $year = $request->year;
        $start_date = $year.'-'.$request->month.'-01';
        $end_date = date("Y-m-t", strtotime($start_date));
        $prev_month_ts = strtotime($start_date.' -1 month');
        $prev_month = date('m', $prev_month_ts);
        $prev_year = date('Y', $prev_month_ts);
        $dt = $prev_year.'-'.$prev_month;
        $month = date('m', mktime(0,0,0,$request->month, 1, date('Y')));
        $startDate = date("Y-m-01", strtotime($dt));
        $endDate = date("Y-m-t", strtotime($dt));
        $settlement = DB::table('settlements')->where('start_date', $start_date)->where('end_date', $end_date)->first();
        if(empty($settlement)){
            $settlement = new Settlement();
            $settlement->month = $month;
            $settlement->year = $year;
            $settlement->start_date = $start_date;
            $settlement->end_date = $end_date;
            $settlement->prev_start_date = $startDate;
            $settlement->prev_end_date = $endDate;
            $settlement->save();
            foreach($users as $user)
            {
                if($user->plan_amt == 3600)
                {
                    $perMonth = 400;
                    $afterSixMonth = 3000;
                    $perJoin = 600;
                }
                elseif($user->plan_amt == 7200)
                {
                    $perMonth = 900;
                    $afterSixMonth = 6200;
                    $perJoin = 1400;
                }
                elseif($user->plan_amt == 14400){
                    $perMonth = 2100;
                    $afterSixMonth = 13400;
                    $perJoin = 3000;
                }
                $userOrderDetail = UserOrder::where('user_id', $user->id)->where('pay_amount', $user->plan_amt)->first();
                $userPaymentDetail = UserPayment::where('order_id', $userOrderDetail->id)->first();
                
                $busiStartDateConvert = strtotime($userPaymentDetail->payment_datetime);
                $busiStartDate = date("Y-m-d", strtotime("+1 month", $busiStartDateConvert));
                $busiEndDate = date("Y-m-d", strtotime("+7 month", $busiStartDateConvert));
                $busiStartMonth = date("m", strtotime($busiStartDate));
                $busiStartYear = date("Y", strtotime($busiStartDate));
                $busiEndMonth = date("m", strtotime($busiEndDate));
                $busiEndYear = date("Y", strtotime($busiEndDate));
                $planEndDate = date("Y-m-d", strtotime("+6 month", $busiStartDateConvert));
                $planEndCalDate = date("Y-m-t", strtotime($planEndDate));
                if($user->income_settlement == 1)
                {
                    $joiner = DB::table('users')->where('parent_id', $user->id)->where('registration_payment', 'Yes')->join('user_plans', 'user_plans.user_id', '=', 'users.id')->select('user_plans.*', 'users.parent_id', 'users.registration_payment')->where('user_plans.plan_category', 'Money Plant')->where('user_plans.payment_status', 'Successful')->where('user_plans.payment_date', '!=', null)->whereBetween('user_plans.payment_date', [$startDate, $endDate])->get();
                    // return $joiner;
                    if((date("Y-m", strtotime($request->year.'-'.$request->month)) >= date("Y-m", strtotime($busiStartYear.'-'.$busiStartMonth))) && (date("Y-m", strtotime($request->year.'-'.$request->month)) <= date("Y-m", strtotime($busiEndYear.'-'.$busiEndMonth))))
                    {
                        if(date("Y-m", strtotime($request->year.'-'.$request->month)) == date("Y-m", strtotime($busiEndYear.'-'.$busiEndMonth))){
                            $total = $perMonth + (count($joiner) * $perJoin) + $user->plan_amt;
                        }
                        else{
                            $total = $perMonth + (count($joiner) * $perJoin);
                        }
                        $paymentSettlement = new PaymentSettlement();
                        $paymentSettlement->settlement_id = $settlement->id;
                        $paymentSettlement->user_id = $user->id;
                        $paymentSettlement->total = $total;
                        $paymentSettlement->from_date = $startDate;
                        $paymentSettlement->to_date = $endDate;
                        $paymentSettlement->save();
                    }
                }
                elseif($user->income_settlement == 6)
                {
                    $joiner = User::where('parent_id', $user->id)->where('registration_pay', 'Yes')->join('user_plans', 'user_plans.user_id', '=', 'users.id')->select('user_plans.*')->where('user_plans.plan_category', 'Money Plant')->where('user_plans.payment_status', 'Successful')->whereBetween('user_plans.payment_date', [$startDate, $planEndCalDate])->get();
                    $total = $perMonth + (count($joiner) * $perJoin) + $user->plan_amt;
                    $paymentSettlement = new PaymentSettlement();
                    $paymentSettlement->settlement_id = $settlement->id;
                    $paymentSettlement->user_id = $user->id;
                    $paymentSettlement->total = $total;
                    $paymentSettlement->from_date = $startDate;
                    $paymentSettlement->to_date = $planEndCalDate;
                    $paymentSettlement->save();
                }
            }
            return response()->json(['success' => 'Payment Settlement Generated Successfully!']);
        }
        else{
            return response()->json(['error' => 'Payment Settlement Already Generated!']);
        }
    }
    
    public function viewPaymentSettlement($id)
    {
        $settlement = Settlement::findorfail($id);
        $paymentSettlement = PaymentSettlement::where('settlement_id', $id)->where('settled_status', 0)->get();
        if(request()->ajax())
        {
            return datatables()->of($paymentSettlement)
            ->addColumn('name', function($row){
                $user = User::where('id', $row->user_id)->first();
                if(!empty($user)){
                    return $user->first_name." ".$user->middle_name." ".$user->last_name;
                }
            })
            ->addColumn('action', function($row){
                return '<button type="button" id="status" data-id="'.$row->id.'" class="btn btn-success">Clear Due</button>';
            })
            ->rawColumns(['name', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment-settlement.view', compact('settlement'));
    }
    
    public function paidPaymentSettlement($id)
    {
        $settlement = Settlement::findorfail($id);
        $paymentSettlement = PaymentSettlement::where('settlement_id', $id)->where('settled_status', 1)->get();
        if(request()->ajax())
        {
            return datatables()->of($paymentSettlement)
            ->addColumn('name', function($row){
                $user = User::where('id', $row->user_id)->first();
                if(!empty($user)){
                    return $user->first_name." ".$user->middle_name." ".$user->last_name;
                }
            })
            ->addColumn('action', function($row){
                return '<button type="button" id="status" data-id="'.$row->id.'" class="btn btn-danger">Revert Due</button>';
            })
            ->rawColumns(['name', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
    
    public function paymentSettlementStatus(Request $request)
    {
        $due_id = $request->id;
        $paymentSettlement = PaymentSettlement::where('id', $due_id)->first();
        if($paymentSettlement->settled_status == 0)
        {
            DB::table('payment_settlements')->where('id',$due_id)->update(['settled_status' => 1, 'settled_date' => date('Y-m-d')]);
            return response()->json(['success' => 'Due Settled Successfully!']);
        }
        else{
            DB::table('payment_settlements')->where('id',$due_id)->update(['settled_status' => 0, 'settled_date' => date('Y-m-d')]);
            return response()->json(['success' => 'Due Reverted Successfully!']);
        }
    }
   
}
