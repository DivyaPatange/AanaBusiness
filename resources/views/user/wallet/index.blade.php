<?php 
use App\Models\User\Income;
?>
@extends('user.user_layout.main')
@section('title', 'My Wallet')
@section('page_title', 'My Wallet')
@section('customcss')
<link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/60f2fb32da.js" crossorigin="anonymous"></script>
<style>
.hidden{
    display:none;
}
.tf-nc
{
    border:none !important;
}
.tf-nc a
{
    color:white;
}
.tf-tree .tf-nc:after, .tf-tree .tf-nc:before, .tf-tree .tf-node-content:after, .tf-tree .tf-node-content:before{
    border-left:.0625em solid #f0eeee;
}
.tf-tree li li:before{
    border-top:.0625em solid #f0eeee;
}
</style>
@endsection
@section('content')
<div class="row mt--2 d-none">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center bg-dark text-white">
                <div class="tf-tree example">
                    <ul>
                        <li>
                           
                            <ul>
                                                        
                                @foreach($users as $user)
                                <?php
                                    $userPlan = DB::table('user_plans')->where('user_id', $user->id)->where('payment_status', 'Successful')->first();
                                    if(!empty($userPlan))
                                    {
                                        $income = DB::table('incomes')->where('child_id', $user->id)->where('user_id', Auth::user()->id)->first();
                                        if(empty($income))
                                        {
                                            $userOrder = DB::table('user_orders')->where('user_id', $user->id)->where('pay_amount', $userPlan->plan_amt)->first();
                                            $userPayment = DB::table('user_payments')->where('user_id', $user->id)->where('order_id', $userOrder->id)->first();
                                            $income = new Income();
                                            $income->user_id = Auth::user()->id;
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
                                    
                                        @include('user.wallet.manageChild',['childs' => $user->childs])                                                
                                    @endif
                                                                                    
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt--2">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5><b>Total Income</b></h5>
                        <p class="text-muted">All Customs Value</p>
                    </div>
                    <h3 class="text-info fw-bold">&#8377;{{ $wallet->sum('wallet_amt') }}</h3>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-info w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <p class="text-muted mb-0">Change</p>
                    <p class="text-muted mb-0">75%</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Statement</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
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
<script src="{{ asset('treeview.js') }}"></script>
@endsection