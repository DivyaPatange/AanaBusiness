@extends('user.user_layout.main')
@section('title', 'KYC Document')
@section('page_title', 'KYC Document')
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
    <div class="col-md-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Upload Document</h4>
                @if(isset($kycDetails) && !empty($kycDetails) && $kycDetails->verified == 1)
                <span style="color:green;font-size:30px;">Your KYC Verification is Approved</span>
                @else
                <span style="color:red;font-size:30px;">Your KYC Verification is Pending</span>
                @endif
                <br>
                <br>
            </div>
            <form method="POST" id="submitForm" action="{{ route('user.kyc-document.upload') }}" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <div class="form-group">
                                <label for="pan_img">PAN Card</label>
                                <input id="pan_img" name="pan_img" type="file" class="form-control">
                                @error('pan_img')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for=""></label>
                            @if(isset($kycDetails) && !empty($kycDetails) && isset($kycDetails->pan_img))
                            <a href="{{ URL::asset('kycdocument/pan/' . $kycDetails->pan_img) }}" target="_blank" class="btn btn-primary" style="margin-top:32px;">View</a>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="form-group">
                                <label for="aadhar_img">Aadhar Card</label>
                                <input id="aadhar_img" name="aadhar_img" type="file" class="form-control">
                                @error('aadhar_img')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for=""></label>
                            @if(isset($kycDetails) && !empty($kycDetails) && isset($kycDetails->aadhar_img))
                            <a href="{{ URL::asset('kycdocument/aadhar/' . $kycDetails->aadhar_img) }}" target="_blank" class="btn btn-primary" style="margin-top:32px;">View</a>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="form-group">
                                <label for="user_img">User Image</label>
                                <input id="user_img" name="user_img" type="file" class="form-control">
                                @error('user_img')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for=""></label>
                            @if(isset($kycDetails) && !empty($kycDetails) && isset($kycDetails->user_img))
                            <a href="{{ URL::asset('kycdocument/user/' . $kycDetails->user_img) }}" target="_blank" class="btn btn-primary" style="margin-top:32px;">View</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" id="submitButton" class="btn btn-success">Upload</button>
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