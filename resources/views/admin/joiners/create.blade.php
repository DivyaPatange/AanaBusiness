@extends('admin.admin_layout.main')
@section('title', 'Add User')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add User</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.joiners.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" name="first_name" placeholder="Enter First Name">
                                @error('first_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" value="{{ old('middle_name') }}" name="middle_name" placeholder="Enter Middle Name">
                                @error('middle_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" name="last_name" placeholder="Enter Last Name">
                                @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" value="{{ old('username') }}" name="username" placeholder="Enter Username">
                                @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" value="{{ old('password') }}" name="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="mobile_no1">Mobile No. 1</label>
                                <input type="number" class="form-control" id="mobile_no1" value="{{ old('mobile_no1') }}" name="mobile_no1" placeholder="Enter Mobile No. 1">
                                @error('mobile_no1')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="mobile_no2">Mobile No. 2</label>
                                <input type="number" class="form-control" id="mobile_no2" value="{{ old('mobile_no2') }}" name="mobile_no2" placeholder="Enter Mobile No. 2">
                                @error('mobile_no2')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="land_line">Land Line No.</label>
                                <input type="number" class="form-control" id="land_line" value="{{ old('land_line') }}" name="land_line" placeholder="Enter Land Line No.">
                                @error('land_line')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Enter Email ID">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" value="{{ old('dob') }}" name="dob" >
                                @error('dob')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="blood_group">Blood Group</label>
                                <input type="text" class="form-control" id="blood_group" value="{{ old('blood_group') }}" name="blood_group" placeholder="Enter Blood Group">
                                @error('blood_group')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="promoter_name">Promoter Name</label>
                                <input type="text" class="form-control" id="promoter_name" value="{{ old('promoter_name') }}" name="promoter_name" placeholder="Enter Promoter Name">
                                @error('promoter_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="promoter_mobile">Promoter Mobile No.</label>
                                <input type="number" class="form-control" id="promoter_mobile" value="{{ old('promoter_mobile') }}" name="promoter_mobile" placeholder="Enter Promoter Mobile No.">
                                @error('promoter_mobile')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" value="{{ old('address') }}" name="address" placeholder="Enter Address">
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" value="{{ old('city') }}" name="city" placeholder="Enter City">
                                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="pincode">Pincode</label>
                                <input type="number" class="form-control" id="pincode" value="{{ old('pincode') }}" name="pincode" placeholder="Enter Pincode">
                                @error('pincode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" id="photo" value="{{ old('photo') }}" name="photo">
                                @error('photo')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="payment_mode">Payment Mode</label>
                                <select class="form-control" id="payment_mode" name="payment_mode">
                                    <option value="">Select Payment Mode</option>
                                    <option value="Credit Card" @if(old('payment_mode') == "Credit Card") Selected @endif>Credit Card</option>
                                </select>
                                @error('payment_mode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customjs')

@endsection