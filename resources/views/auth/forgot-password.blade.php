@extends('auth.auth_layout.main_layout')
@section('title', 'Forgot Password')
@section('customcss')
<style>
    
</style>
@endsection
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Forgot Password</h2>
          <p>Reset Password Here</p>
        </div>
        <div class="row">
            <div class="col-lg-5 m-auto">
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
        <div class="row">
          <div class="col-lg-5 m-auto">
           
            <form action="{{ route('reset.password') }}" method="post" role="form" class="php-email-form">
                @csrf
                <div class="form-group">
                    <label>Username </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Enter User Name" value="{{ old('username') }}"/>
                    <div class="validate">
                        @error('username')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-center"><button type="submit">Submit</button></div>
                <div class="text-center mt-3"><a href="{{ url('/login') }}" class="">Login</a></div>
            </form>
        </div>
    </div>

      </div>
    </section><!-- End Contact Section -->
@endsection
@section('customjs')
<script>

</script>
@endsection