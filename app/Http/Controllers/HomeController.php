<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\UserPlan;
use Auth;
use App\Models\User;
use App\Models\User\JoinerLevel;
use DateTime;
use DB;
use App\Models\Admin\UserInfo;
use App\Models\Admin\UserOrder;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userPlan = UserPlan::where('user_id', Auth::user()->id)->first();
        // dd($userPlan);
        $users = User::where('parent_id', '=', Auth::user()->id)
        ->where('registration_payment', 'Yes')
        ->where('status', 'Active')
        ->get();
        $joinerLevel1 = JoinerLevel::where('user_id', Auth::user()->id)->where('level', 1)->first();
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
                    $parentUserPlan = UserPlan::where('user_id', Auth::user()->id)->first();
                    if(!empty($parentUserPlan)){
                        $userOrder = DB::table('user_orders')->where('user_id', $parentUserPlan->user_id)->where('pay_amount', $parentUserPlan->plan_amt)->first();
                        $userPayment = DB::table('user_payments')->where('order_id', $userOrder->id)->where('user_id', Auth::user()->id)->first();
                        $paymentDate = new DateTime($userPayment->payment_datetime);
                        $converted_at = $paymentDate->format('Y-m-d');
                        $dt = strtotime($converted_at);
                        $completionTime = $parentUserPlan->completion_time." day";
                        $extendedDate = date("Y-m-d", strtotime($completionTime , $dt));
                        $payment_dt = new Datetime(max($items1));
                        $payment_converted_at = $payment_dt->format('Y-m-d');
                        if (($payment_converted_at >= $converted_at) && ($payment_converted_at <= $extendedDate)){ 
                            $updateLevel = JoinerLevel::where('user_id', Auth::user()->id)->where('level', 1)->update(['status' => 1]);
                        }  
                        else{
                            $userStatus = User::where('id', Auth::user()->id)->update(['status' => 'Deactive']);
                        }
                    }
                }
            }
        }
        else{
            $joinerLevel1 = new JoinerLevel();
            $joinerLevel1->user_id = Auth::user()->id;
            $joinerLevel1->level = 1;
            $joinerLevel1->total_joiner = 4;
            $joinerLevel1->joiner_added = count($users);
            $joinerLevel1->save();
        }
        $joinerLevel2 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 2)->first();
        if(empty($joinerLevel2))
        {
            $joinerLevel = new JoinerLevel();
            $joinerLevel->user_id = Auth::user()->id;
            $joinerLevel->level = 2;
            $joinerLevel->total_joiner = 16;
            $joinerLevel->joiner_added = 0;
            $joinerLevel->save();
        }
        else{
            if(($joinerLevel2->status == 1) && ($joinerLevel2->new_acc == 0))
            {
                $password = str_random(8);
                $id = mt_rand(10000000,99999999);
                $user = new User();
                $user->id = $id;
                $user->first_name = Auth::user()->first_name;
                $user->middle_name = Auth::user()->middle_name;
                $user->last_name = Auth::user()->last_name;
                $user->username = "ANB".$id;
                $user->password = Hash::make($password);
                $user->show_password = $password;
                $user->mobile_no1 = Auth::user()->mobile_no1;
                $user->mobile_no2 = Auth::user()->mobile_no2;
                $user->land_line = Auth::user()->land_line;
                $user->parent_id = Auth::user()->parent_id;
                $user->email = Auth::user()->email;
                $user->status = "Active";
                $user->registration_payment = "Yes";
                $user->save();
                $info = UserInfo::where('user_id', Auth::user()->id)->first();
                $userInfo = new UserInfo();
                $userInfo->user_id = $id;
                $userInfo->dob = $info->dob;
                $userInfo->blood_group = $info->blood_group;
                $userInfo->promoter_name = $info->promoter_name;
                $userInfo->promoter_mobile = $info->promoter_mobile;
                $userInfo->address = $info->address;
                $userInfo->payment_mode = $info->payment_mode;
                $userInfo->city = $info->city;
                $userInfo->pincode = $info->pincode;
                $userInfo->photo = $info->photo;
                $userInfo->save();
                $authPlan = UserPlan::where('user_id', Auth::user()->id)->where('payment_status', 'Successful')->first();
                $plan = new UserPlan();
                $plan->user_id = $id;
                $plan->plan_category = $authPlan->plan_category;
                $plan->plan_amt = $authPlan->plan_amt;
                $plan->completion_time = $authPlan->completion_time;
                $plan->busi_validity = $authPlan->busi_validity;
                $plan->payment_status = "Pending";
                $plan->save();
                $planOrder = new UserOrder();
                $planOrder->user_id = $id;
                $planOrder->order_number = 'ORD-'.strtoupper(uniqid());
                $planOrder->pay_amount = $plan->plan_amt;
                $planOrder->save();
                $updateLevel = JoinerLevel::where('user_id', Auth::user()->id)->where('level', 2)->update(['new_acc' => 1]);
            }
        }
        $allMenus = User::pluck('first_name','id', 'last_name', 'username')->all();
        return view('user.dashboard', compact('userPlan', 'users', 'allMenus', 'joinerLevel1', 'items2', 'items3', 'items4', 'items5', 'items6', 'items7'));
    }
}
