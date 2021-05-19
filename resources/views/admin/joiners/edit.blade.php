@extends('admin.admin_layout.main')
@section('title', 'Edit User')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.joiners.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}" name="first_name" placeholder="Enter First Name">
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
                                <input type="text" class="form-control" id="middle_name" value="{{ $user->middle_name }}" name="middle_name" placeholder="Enter Middle Name">
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
                                <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" name="last_name" placeholder="Enter Last Name">
                                @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="mobile_no1">Mobile No. 1</label>
                                <input type="number" class="form-control" id="mobile_no1" value="{{ $user->mobile_no1 }}" name="mobile_no1" placeholder="Enter Mobile No. 1">
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
                                <input type="number" class="form-control" id="mobile_no2" value="{{ $user->mobile_no2 }}" name="mobile_no2" placeholder="Enter Mobile No. 2">
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
                                <input type="number" class="form-control" id="land_line" value="{{ $user->land_line }}" name="land_line" placeholder="Enter Land Line No.">
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
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email" placeholder="Enter Email ID">
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
                                <input type="date" class="form-control" id="dob" value="{{ $userInfo->dob }}" name="dob" >
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
                                <input type="text" class="form-control" id="blood_group" value="{{ $userInfo->blood_group }}" name="blood_group" placeholder="Enter Blood Group">
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
                                <input type="text" class="form-control" id="promoter_name" value="{{ $userInfo->promoter_name }}" name="promoter_name" placeholder="Enter Promoter Name">
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
                                <input type="number" class="form-control" id="promoter_mobile" value="{{ $userInfo->promoter_mobile }}" name="promoter_mobile" placeholder="Enter Promoter Mobile No.">
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
                                <input type="text" class="form-control" id="address" value="{{ $userInfo->address }}" name="address" placeholder="Enter Address">
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
                                <input type="text" class="form-control" id="city" value="{{ $userInfo->city }}" name="city" placeholder="Enter City">
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
                                <input type="number" class="form-control" id="pincode" value="{{ $userInfo->pincode }}" name="pincode" placeholder="Enter Pincode">
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
                        <input type="hidden" class="form-control" name="hidden_image" value="{{ $userInfo->photo }}">
                        @if($userInfo->photo)
                        <div class="col-md-6">
                            <div class="form-group mt-4"> 
                                <a href="{{  URL::asset('UserPhoto/' . $userInfo->photo) }}" target="_blank"">Click to View</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customjs')

@endsection