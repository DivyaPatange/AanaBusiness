@extends('user.user_layout.main')
@section('title', 'Edit Profile')
@section('page_title', 'Edit Profile')
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Profile</h4>
            </div>
            <?php 
                $id = Auth::user()->id;
            ?>
            <form method="POST" id="submitForm" action="{{ route('user.profile-update', $id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" value="{{ $user->first_name }}" type="text" class="form-control">
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
                                <input id="middle_name" name="middle_name" value="{{ $user->middle_name }}" type="text" class="form-control">
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
                                <input id="last_name" name="last_name" value="{{ $user->last_name }}" type="text" class="form-control">
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
                                <input id="mobile_no1" name="mobile_no1" value="{{ $user->mobile_no1 }}" type="number" class="form-control">
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
                                <input id="mobile_no2" name="mobile_no2" value="{{ $user->mobile_no2 }}" type="number" class="form-control">
                                @error('mobile_no2')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="land_line">Landline No.</label>
                                <input id="land_line" name="land_line" value="{{ $user->land_line }}" type="number" class="form-control">
                                @error('land_line')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input id="email" name="email" value="{{ $user->email }}" type="email" class="form-control">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input id="dob" name="dob" value="{{ $userInfo->dob }}" type="date" class="form-control">
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
                                <input id="blood_group" name="blood_group" value="{{ $userInfo->blood_group }}" type="text" class="form-control">
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
                                <input id="promoter_name" name="promoter_name" value="{{ $userInfo->promoter_name }}" type="text" class="form-control">
                                @error('promoter_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="promoter_mobile">Promoter Mobile</label>
                                <input id="promoter_mobile" name="promoter_mobile" value="{{ $userInfo->promoter_mobile }}" type="number" class="form-control">
                                @error('promoter_mobile')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="address">Address</label>
                                <input id="address" name="address" value="{{ $userInfo->address }}" type="text" class="form-control">
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="city">City</label>
                                <input id="city" name="city" value="{{ $userInfo->city }}" type="text" class="form-control">
                                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="pincode">Pincode</label>
                                <input id="pincode" name="pincode" value="{{ $userInfo->pincode }}" type="number" class="form-control">
                                @error('pincode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="photo">Photo</label>
                                <input id="photo" name="photo" type="file" class="form-control">
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
                                <label for="payment_mode"></label>
                                <a href="{{  URL::asset('UserPhoto/' . $userInfo->photo) }}" target="_blank" class="">Click to View</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" id="submitButton" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script >

</script>
@endsection