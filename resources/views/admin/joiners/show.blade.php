<?php 
use App\Models\User\Income;

if(!empty($userPlan)){
    $paymentDate = new DateTime($userPayment->payment_datetime);
    $converted_at = $paymentDate->format('m/d/Y');
    $dt = strtotime($converted_at);
    // dd($dt);
    $completionTime = $userPlan->completion_time." day";
    // dd($completionTime);
    $extendedDate = date("m/d/Y", strtotime($completionTime , $dt));
    // dd($converted_at);
    $startTimeStamp = strtotime($converted_at);
    $endTimeStamp = strtotime($extendedDate);

    $timeDiff = abs($endTimeStamp - $startTimeStamp);
    // dd($timeDiff);
    $numberDays = $timeDiff/86400;  // 86400 seconds in one day
    // dd($numberDays);
    // and you might want to convert to integer
    $numberDays = intval($numberDays);
    // dd($numberDays);
}
?>
@extends('admin.admin_layout.main')
@section('title', 'User Profile')
@section('customcss')
<?php if(!empty($userPlan)){
    if($joinerLevel1->status == 0) {
?>
<script type="text/JavaScript">  
var deadline = new Date("{{ $extendedDate }}").getTime();

var x = setInterval(function() { 
var now = new Date().getTime(); 
var t = deadline - now; 
// alert(t);
var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
var seconds = Math.floor((t % (1000 * 60)) / 1000); 
document.getElementById("demo").innerHTML = days + "d "  
+ hours + "h " + minutes + "m " + seconds + "s "; 
// alert(t < 0);
    if (t < 0) { 
        clearInterval(x); 
        document.getElementById("demo").innerHTML = ""; 
        $("#hideDiv").hide();
    } 

}, 1000);
</script>
<?php } }
// dd($userPlan);
?>

@endsection
@section('content')
<ul class="d-none">
    <li>
        
        <ul>
                                    
            @foreach($users as $user)
            <?php
                $userPlan = DB::table('user_plans')->where('user_id', $user->id)->where('payment_status', 'Successful')->first();
                if(!empty($userPlan))
                {
                    $income = DB::table('incomes')->where('child_id', $user->id)->where('user_id', $userProfile->id)->first();
                    if(empty($income))
                    {
                        $userOrder = DB::table('user_orders')->where('user_id', $user->id)->where('pay_amount', $userPlan->plan_amt)->first();
                        $userPayment = DB::table('user_payments')->where('user_id', $user->id)->where('order_id', $userOrder->id)->first();
                        $income = new Income();
                        $income->user_id = $userProfile->id;
                        $income->child_id = $user->id;
                        $income->level = 1;
                        $income->plan_amount = $userPlan->plan_amt;
                        $income->payment_date = $userPayment->payment_datetime;
                        $income->income_amount = 0.3333 * $userPlan->plan_amt;
                        $income->save();
                    }
                }
            ?>
            @if(!empty($userPlan))
            <li>
                
                
                
                @if(count($user->childs))
                
                    @include('admin.joiners.manageChild',['childs' => $user->childs])                                                
                @endif
                                                                
            </li>
            @endif
            @endforeach
        </ul>
    </li>
</ul>
<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Login To Account</a>
                <form action="{{ route('login') }}" method="post" target="_blank">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $userProfile->id}}">
                    <input type="hidden" name="username" value="{{ $userProfile->username }}">
                    <input type="hidden" name="password" value="{{ $userProfile->show_password}}">
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Full Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userProfile->first_name }} {{ $userProfile->middle_name }} {{ $userProfile->last_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Username</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userProfile->username }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Mobile No.</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userProfile->mobile_no1 }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Address</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->address }}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @if($joinerLevel1->status == 0)
    <div class="col-md-6">
        <div class="media widget-media p-4 bg-white border" id="hideDiv">
            <div class="icon rounded-circle mr-4 bg-danger">
                <i class="mdi mdi-bell-ring-outline text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2">Time Require for completing 4 Joiners</h4>
                <p id="demo"></p>
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle mr-4 bg-primary">
                <i class="mdi mdi-security text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h5 class="text-primary mb-2">Plan Category</h5>
                <p>{{ $userPlan->plan_category }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle bg-warning mr-4">
                <i class="mdi mdi-set-none text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h5 class="text-primary mb-2">Plan Amount</h5>
                <p>{{ $userPlan->plan_amt }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle mr-4 bg-danger">
                <i class="mdi mdi-alarm text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h5 class="text-primary mb-2">Completion Time</h5>
                <p>{{ $userPlan->completion_time }} days</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon bg-success rounded-circle mr-4">
                <i class="mdi mdi-diamond text-white "></i>
            </div>
            <div class="media-body align-self-center">
                <h5 class="text-primary mb-2">Business Validity</h5>
                <p>{{ $userPlan->busi_validity }} Months</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-12">
        <!-- Notification Table -->
        <div class="card card-default" data-scroll-height="550" style="height: 550px; overflow: hidden;">
            <div class="card-header justify-content-between ">
                <h2>Plan Payment Details</h2>
                <div>
                    <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                    <!-- <div class="dropdown show d-inline-block widget-dropdown">
                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-notification">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="card-body slim-scroll" style="overflow: hidden; width: auto; height: 100%;">
                    <div class="media pb-3 align-items-center justify-content-between">
                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                            <i class="mdi mdi-calendar-blank font-size-20"></i>
                        </div>
                        <div class="media-body pr-3 ">
                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Transaction ID</a>
                            <p>@if(!empty($userPayment)) {{ $userPayment->transaction_id }} @endif</p>
                        </div>
                    </div>

                    <div class="media py-3 align-items-center justify-content-between">
                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                            <i class="mdi mdi-stack-exchange font-size-20"></i>
                        </div>
                        <div class="media-body pr-3">
                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Payment Mode</a>
                            <p>@if(!empty($userPayment)) {{ $userPayment->payment_mode }} @endif</p>
                        </div>
                    </div>


                    <div class="media py-3 align-items-center justify-content-between">
                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                            <i class="mdi mdi-stack-exchange font-size-20"></i>
                        </div>
                        <div class="media-body pr-3">
                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Payment Channel</a>
                            <p>@if(!empty($userPayment)) {{ $userPayment->payment_channel }} @endif</p>
                        </div>
                    </div>

                    <div class="media py-3 align-items-center justify-content-between">
                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                            <i class="mdi-alarm-check font-size-20"></i>
                        </div>
                        <div class="media-body pr-3">
                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Payment Date</a>
                            <p>@if(!empty($userPayment)) {{ $userPayment->payment_datetime }} @endif</p>
                        </div>
                    </div>
                </div>
                <div class="slimScrollBar" style="background: rgb(153, 153, 153); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 232.963px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
            <div class="mt-3"></div>
        </div>
    </div>
    <div class="col-xl-8 col-md-8 col-12">
        <div class="card widget-block p-4 rounded bg-white border">
            <div class="card-block">
                <h4 class="text-primary my-2">&#8377;{{ $wallet->sum('wallet_amt') }}</h4>
                <p class="pb-3">Total Income</p>
                <div class="progress my-2" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Statement</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Credited Date</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wallet as $key => $w)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ date('d-m-Y', strtotime($w->income_date)) }}</td>
                            <td>&#8377;{{ $w->wallet_amt }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Total</td>
                            <td >&#8377;{{ $wallet->sum('wallet_amt') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')

@endsection