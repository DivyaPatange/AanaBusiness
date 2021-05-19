@extends('user.user_layout.main')
@section('title', 'My Profile')
@section('page_title', 'My Profile')
@section('customcss')
<style>
.hidden{
    display:none;
}
</style>

@endsection
@section('content')
<div class="row mt--2">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('danger'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif
    </div>
</div>
<div class="row mt--2">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                @if(!empty($userInfo->photo))
                <img src="{{ URL::asset('UserPhoto/' . $userInfo->photo) }}" alt="" class="img-fluid">
                @else
                <img src="" alt="">
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>First Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->first_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Middle Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->middle_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Last Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->last_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Username</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->username }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Personal Info</h4>
                <a href="{{ route('user.edit-profile') }}"><button type="button" class="btn btn-danger">Edit Profile</button></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Full Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->email }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Mobile No. 1</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->mobile_no1 }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Mobile No. 2</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->mobile_no2 }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Land Line</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $user->land_line }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Date Of Birth</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ date('d-m-Y', strtotime($userInfo->dob)) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Blood Group</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->blood_group }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Address</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->address }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>City</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->city }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Pincode</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->pincode }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Promoter Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->promoter_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Promoter Mobile</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $userInfo->promoter_mobile }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script >

</script>
@endsection