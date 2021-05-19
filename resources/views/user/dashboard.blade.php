
<?php 
use App\Models\User\JoinerLevel;
use App\Models\User\Income;

    $userPlan1 = DB::table('user_plans')->where('user_id', Auth::user()->id)->where('payment_status', 'Successful')->first();
    if(!empty($userPlan1)){
        $userOrder = DB::table('user_orders')->where('user_id', $userPlan1->user_id)->where('pay_amount', $userPlan1->plan_amt)->first();
        $userPayment = DB::table('user_payments')->where('order_id', $userOrder->id)->where('user_id', Auth::user()->id)->first();
        $paymentDate = new DateTime($userPayment->payment_datetime);
        $converted_at = $paymentDate->format('m/d/Y');
        $dt = strtotime($converted_at);
        // dd($dt);
        $completionTime = $userPlan1->completion_time." day";
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
@extends('user.user_layout.main')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('customcss')
<style>
.hidden{
    display:none;
}
</style>
<?php if(!empty($userPlan1)){
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
                $plan = DB::table('user_plans')->where('user_id', $user->id)->where('payment_status', 'Successful')->first();
                if(!empty($plan))
                {
                    $income = DB::table('incomes')->where('child_id', $user->id)->where('user_id', Auth::user()->id)->first();
                    if(empty($income))
                    {
                        $userOrder = DB::table('user_orders')->where('user_id', $user->id)->where('pay_amount', $plan->plan_amt)->first();
                        $userPayment = DB::table('user_payments')->where('user_id', $user->id)->where('order_id', $userOrder->id)->first();
                        $income = new Income();
                        $income->user_id = Auth::user()->id;
                        $income->child_id = $user->id;
                        $income->level = 1;
                        $income->plan_amount = $plan->plan_amt;
                        $income->payment_date = $userPayment->payment_datetime;
                        $income->income_amount = 0.3333 * $plan->plan_amt;
                        $income->save();
                    }
                    $joinerLevel = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 1)->first();
                    if(empty($joinerLevel))
                    {
                        $joinerLevel = new JoinerLevel();
                        $joinerLevel->user_id = Auth::user()->id;
                        $joinerLevel->level = 1;
                        $joinerLevel->total_joiner = 4;
                        $joinerLevel->joiner_added = count($users);
                        $joinerLevel->save();
                    }
                    else{
                        $result = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 1)->update(['joiner_added' => count($users)]);
                    }
                }
            ?>
            @if(!empty($plan))
            <li>
                
                
                
                @if(count($user->childs))
                    @include('user.wallet.manageChild',['childs' => $user->childs])                                                
                @endif
                                                                
            </li>
            @endif
            @endforeach
        </li>
    </ul>
</ul>
@if(empty($userPlan))
<div class="row mt--2">
    <div class="col-md-6 m-auto">
        <div class="card full-height">
            <div class="card-header">
                <div class="card-title">Plan Details</div>
            </div>
            <form action="{{ route('user.save-plan') }}" id="submitForm" method="POST">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="plan">Select Plan <span class="text-danger" id="plan_err"></span></label>
                        <select class="form-control" id="plan" name="plan">
                            <option value="">-Select Plan-</option>
                            <option value="General Category">General Category</option>
                            <option value="Golden Category">Golden Category</option>
                            <option value="Platinum Category">Platinum Category</option>
                        </select>
                    </div>
                    <div class="form-check hidden" id="showDiv1">
                        <label>Plan Amount <span class="text-danger amt_err"></span></label><br>
                        <label class="form-radio-label">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="360">
                            <span class="form-radio-sign">2 Aana : Rs. 360</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="720">
                            <span class="form-radio-sign">4 Aana : Rs. 720</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="900">
                            <span class="form-radio-sign">8 Aana : Rs. 900</span>
                        </label>
                    </div>
                    <div class="form-check hidden" id="showDiv2">
                        <label>Plan Amount <span class="text-danger amt_err"></span></label><br>
                        <label class="form-radio-label">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="1440">
                            <span class="form-radio-sign">10 Aana : Rs. 1440</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="1800">
                            <span class="form-radio-sign">16 Aana : Rs. 1800</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="3600">
                            <span class="form-radio-sign">40 Aana : Rs. 3600</span>
                        </label>
                    </div>
                    <div class="form-check hidden" id="showDiv3">
                        <label>Plan Amount <span class="text-danger amt_err"></span></label><br>
                        <label class="form-radio-label">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="7200">
                            <span class="form-radio-sign">80 Aana : Rs. 7200</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="9000">
                            <span class="form-radio-sign">100 Aana : Rs. 9000</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="plan_amt" value="14400">
                            <span class="form-radio-sign">160 Aana : Rs. 14400</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="completion_time">Completion Time <span class="text-danger" id="time_err"></span></label>
                        <select class="form-control" id="completion_time" name="completion_time">
                            <option value="">-Select Completion Time-</option>
                            <option value="9">9 days</option>
                            <option value="18">18 days</option>
                            <option value="27">27 days</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="busi_validity">Business Validity <span class="text-danger" id="validity_err"></span></label>
                        <select class="form-control" id="busi_validity" name="busi_validity">
                            <option value="">-Select Business Validity-</option>
                            <option value="18">18 Months</option>
                            <option value="36">36 Months</option>
                            <option value="54">54 Months</option>
                        </select>
                    </div>
                </div>
                <div class="card-action">
                    <button type="button" id="submitButton" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="row mt--2">
    @if($userPlan->payment_status == "Successful")
    @if($joinerLevel1->status == 0)
    <div class="col-md-7 m-auto" id="hideDiv">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="flaticon-alarm-1"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <h3 class="">Time Required for Completing 4 Joiners</h3>
                            <h4 class="card-title text-success" id="demo"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Plan Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Plan Category</p>
                                            <h4 class="card-title">{{ $userPlan->plan_category }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-interface-6"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Plan Amount</p>
                                            <h4 class="card-title">{{ $userPlan->plan_amt }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-success card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-analytics"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Completion Time</p>
                                            <h4 class="card-title">{{ $userPlan->completion_time }} days</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-secondary card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Business Validity</p>
                                            <h4 class="card-title">{{ $userPlan->busi_validity }} Months</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
               $order = DB::table('user_orders')->where('user_id', $userPlan->user_id)->where('pay_amount', $userPlan->plan_amt)->first();
            //    dd($order);
            ?>
            @if(!empty($order))
            <?php 
                $userPayment = DB::table('user_payments')->where('order_id', $order->id)->first();
            ?>
            @if(empty($userPayment))
            <div class="card-action">
                <form method="post" action="{{ route('user.pay', $order->id) }}">
                    @csrf
                    <button class="btn btn-success">Payment</button>
                </form>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="card full-height">
            <div class="card-body">
                <div class="card-title">Overall Joiners Added on Each Level</div>
                <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-1"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 4</h6>
                        <h6 class="fw-bold mb-0">Level 1</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-2"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 16</h6>
                        <h6 class="fw-bold mb-0">Level 2</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-3"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 64</h6>
                        <h6 class="fw-bold mb-0">Level 3</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-4"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 256</h6>
                        <h6 class="fw-bold mb-0">Level 4</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-5"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 1024</h6>
                        <h6 class="fw-bold mb-0">Level 5</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-6"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 4096</h6>
                        <h6 class="fw-bold mb-0">Level 6</h6>
                    </div>
                    <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-7"></div>
                        <h6 class="fw-bold mt-3 mb-0">Required : 16384</h6>
                        <h6 class="fw-bold mt-3 mb-0">Level 7</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection 
@section('customjs')
<script>
$('#plan').on('change', function() {
    var query = $(this).val();
    if(query == "General Category")
    {
        $("#showDiv1").show();
        $("#showDiv2").hide();
        $("#showDiv3").hide();
    }
    if(query == "Golden Category")
    {
        $("#showDiv2").show();
        $("#showDiv1").hide();
        $("#showDiv3").hide();
    }
    if(query == "Platinum Category")
    {
        $("#showDiv3").show();
        $("#showDiv2").hide();
        $("#showDiv1").hide();
    }
    if(query == ""){
        $("#showDiv3").hide();
        $("#showDiv2").hide();
        $("#showDiv1").hide();
    }
});
$('#submitButton').on('click', function() {
    var plan = $("#plan").val();
    var plan_amt = $("input[name='plan_amt']:checked").val();
    var completion_time = $("#completion_time").val();
    var busi_validity = $("#busi_validity").val();
    if (plan=="") {
        $("#plan_err").fadeIn().html("Required");
        setTimeout(function(){ $("#plan_err").fadeOut(); }, 3000);
        $("#plan").focus();
        return false;
    }
    if (plan_amt==null) {
        $(".amt_err").fadeIn().html("Required");
        setTimeout(function(){ $(".amt_err").fadeOut(); }, 3000);
        $("input[name='plan_amt']:checked").focus();
        return false;
    }
    if (completion_time=="") {
        $("#time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#time_err").fadeOut(); }, 3000);
        $("#completion_time").focus();
        return false;
    }
    if (busi_validity=="") {
        $("#validity_err").fadeIn().html("Required");
        setTimeout(function(){ $("#validity_err").fadeOut(); }, 3000);
        $("#busi_validity").focus();
        return false;
    }
    else{
        $("#submitForm").submit();
    }
})
</script>
@endsection