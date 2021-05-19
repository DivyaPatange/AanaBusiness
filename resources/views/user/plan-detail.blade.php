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
<div class="row mt--2 justify-content-center align-items-center">
    <div class="col-md-3 pl-md-0">
        <div class="card card-pricing">
            <div class="card-header">
                <div class="card-price">
                    <span class="price">General Category</span>
                </div>
            </div>
            <div class="card-body">
                <ul class="specification-list">
                    <li>
                        <span class="name-specification">2 Aana</span>
                        <span class="status-specification">Rs. 360</span>
                    </li>
                    <li>
                        <span class="name-specification">4 Aana</span>
                        <span class="status-specification">Rs. 720</span>
                    </li>
                    <li>
                        <span class="name-specification">8 Aana</span>
                        <span class="status-specification">Rs. 900</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 pl-md-0 pr-md-0">
        <div class="card card-pricing card-pricing-focus card-primary">
            <div class="card-header">
                <div class="card-price">
                    <span class="price">Golden Category</span>
                </div>
            </div>
            <div class="card-body">
                <ul class="specification-list">
                    <li>
                        <span class="name-specification">10 Aana</span>
                        <span class="status-specification">Rs. 1440</span>
                    </li>
                    <li>
                        <span class="name-specification">16 Aana</span>
                        <span class="status-specification">Rs. 1800</span>
                    </li>
                    <li>
                        <span class="name-specification">40 Aana</span>
                        <span class="status-specification">Rs. 3600</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 pr-md-0">
        <div class="card card-pricing">
            <div class="card-header">
                <div class="card-price">
                    <span class="price">Platinum Category</span>
                </div>
            </div>
            <div class="card-body">
                <ul class="specification-list">
                    <li>
                        <span class="name-specification">80 Aana</span>
                        <span class="status-specification">Rs. 7200</span>
                    </li>
                    <li>
                        <span class="name-specification">100 Aana</span>
                        <span class="status-specification">Rs. 9000</span>
                    </li>
                    <li>
                        <span class="name-specification">160 Aana</span>
                        <span class="status-specification">Rs. 14400</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script>
</script>
@endsection