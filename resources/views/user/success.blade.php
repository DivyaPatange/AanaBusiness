@extends('user.user_layout.main')
@section('title', 'Success')
@section('page_title', 'Success')
@section('customcss')
<style>
.hidden{
    display:none;
}
[class*=" flaticon-"]:before{
    font-weight:bold;
}
</style>

@endsection
@section('content')
<div class="row mt--2">
    <div class="col-md-6 m-auto">
        <div class="card full-height">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="text-success"><b><i class="la flaticon-success">&nbsp;</i></b>Transaction is Successfully Done!</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Transaction ID :</b>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $paymentDetail->transaction_id }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Paid Amount :</b></p>
                    </div>
                    <?php
                        $order = DB::table('user_orders')->where('id', $paymentDetail->order_id)->first();
                    ?>
                    <div class="col-md-8">
                        <p>@if(!empty($order)){{ $order->pay_amount }} @endif</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Payment Date :</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>{{ date('d-m-Y', strtotime($paymentDetail->created_at)) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Payment Mode :</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $paymentDetail->payment_mode }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script>
</script>
@endsection