@extends('user.user_layout.main')
@section('title', 'Joiner')
@section('page_title', 'Add Joiner')
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
                <h4 class="card-title">Add Joiner</h4>
            </div>
            <form method="POST" id="submitForm" action="{{ route('user.joiners.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="reference_id" name="reference_id" value="{{ old('reference_id') }}" type="text" class="form-control input-border-bottom">
                                <label for="reference_id" class="placeholder">Reference ID</label>
                                @error('reference_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 id="referral_name"></h3>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="first_name" name="first_name" value="{{ old('first_name') }}" type="text" class="form-control input-border-bottom">
                                <label for="first_name" class="placeholder">First Name</label>
                                @error('first_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="middle_name" name="middle_name" value="{{ old('middle_name') }}" type="text" class="form-control input-border-bottom">
                                <label for="middle_name" class="placeholder">Middle Name</label>
                                @error('middle_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="last_name" name="last_name" value="{{ old('last_name') }}" type="text" class="form-control input-border-bottom">
                                <label for="last_name" class="placeholder">Last Name</label>
                                @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="username" name="username" value="{{ old('username') }}" type="text" class="form-control input-border-bottom">
                                <label for="username" class="placeholder">Username</label>
                                @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="password" name="password" value="{{ old('password') }}" type="password" class="form-control input-border-bottom">
                                <label for="password" class="placeholder">Password</label>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="mobile_no1" name="mobile_no1" value="{{ old('mobile_no1') }}" type="number" class="form-control input-border-bottom">
                                <label for="mobile_no1" class="placeholder">Mobile No. 1</label>
                                @error('mobile_no1')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="mobile_no2" name="mobile_no2" value="{{ old('mobile_no2') }}" type="number" class="form-control input-border-bottom">
                                <label for="mobile_no2" class="placeholder">Mobile No. 2</label>
                                @error('mobile_no2')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="land_line" name="land_line" value="{{ old('land_line') }}" type="number" class="form-control input-border-bottom">
                                <label for="land_line" class="placeholder">Landline No.</label>
                                @error('land_line')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control input-border-bottom">
                                <label for="email" class="placeholder">Email ID</label>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="dob" name="dob" value="{{ old('dob') }}" type="date" class="form-control input-border-bottom">
                                <label for="dob" class="placeholder">Date Of Birth</label>
                                @error('dob')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-label">
                                <input id="blood_group" name="blood_group" value="{{ old('blood_group') }}" type="text" class="form-control input-border-bottom">
                                <label for="blood_group" class="placeholder">Blood Group</label>
                                @error('blood_group')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="promoter_name" name="promoter_name" value="{{ old('promoter_name') }}" type="text" class="form-control input-border-bottom">
                                <label for="promoter_name" class="placeholder">Promoter Name</label>
                                @error('promoter_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="promoter_mobile" name="promoter_mobile" value="{{ old('promoter_mobile') }}" type="number" class="form-control input-border-bottom">
                                <label for="promoter_mobile" class="placeholder">Promoter Mobile</label>
                                @error('promoter_mobile')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-floating-label">
                                <input id="address" name="address" value="{{ old('address') }}" type="text" class="form-control input-border-bottom">
                                <label for="address" class="placeholder">Address</label>
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="city" name="city" value="{{ old('city') }}" type="text" class="form-control input-border-bottom">
                                <label for="city" class="placeholder">City</label>
                                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="pincode" name="pincode" value="{{ old('pincode') }}" type="number" class="form-control input-border-bottom">
                                <label for="pincode" class="placeholder">Pincode</label>
                                @error('pincode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <input id="photo" name="photo" type="file" class="form-control input-border-bottom">
                                <label for="photo" class="placeholder">Photo</label>
                                @error('photo')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-floating-label">
                                <select id="payment_mode" name="payment_mode" class="form-control input-border-bottom">
                                    <option value="">Select Payment Mode</option>
                                    <option value="Credit Card" @if(old('payment_mode') == "Credit Card") Selected @endif>Credit Card</option>
                                </select>
                                <label for="payment_mode" class="placeholder">Payment Mode</label>
                                @error('payment_mode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" id="submitButton" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script >
var SITEURL = '{{ route('user.joiners.create')}}';
$(document).ready(function () {
    // keyup function looks at the keys typed on the search box
    $('#reference_id').on('keyup',function() {
        // the text typed in the input field is assigned to a variable 
        var query = $(this).val();
        // call to an ajax function
        // alert(query);
        $.ajax({
            // assign a controller function to perform search action - route name is search
            url:"{{ route('user.search') }}",
            // since we are getting data methos is assigned as GET
            type:"GET",
            // data are sent the server
            data:{'reference_id':query},
            // if search is succcessfully done, this callback function is called
            success:function (data) {
                // alert(data);
                // print the search results in the div called country_list(id)
                $('#referral_name').html(data);
            }
        })
        // end of ajax call
    });
})
</script>
@endsection