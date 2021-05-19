@extends('admin.admin_layout.main')
@section('title', 'Payment Success')
@section('customcss')
<script src="https://kit.fontawesome.com/5b3bf3b318.js" crossorigin="anonymous"></script>

@endsection
@section('content')
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-6 m-auto">
        <div class="media widget-media p-4 bg-white border">
            <div class="icon rounded-circle bg-success mr-4">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-4">Transaction is Successful</h4>
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-3"><b>Transaction ID :</b>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-3">{{ $paymentDetail->transaction_id }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-3"><b>Paid Amount :</b></p>
                    </div>
                    <?php
                        $order = DB::table('user_orders')->where('id', $paymentDetail->order_id)->first();
                    ?>
                    <div class="col-md-8">
                        <p class="mb-3">@if(!empty($order)){{ $order->pay_amount }} @endif</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-3"><b>Payment Date :</b></p>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-3">{{ date('d-m-Y', strtotime($paymentDetail->created_at)) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-3"><b>Payment Mode :</b></p>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-3">{{ $paymentDetail->payment_mode }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customjs')

@endsection