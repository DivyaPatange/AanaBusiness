@extends('auth.auth_layout.main_layout')
@section('title', 'Login')
@section('customcss')
<style>
    
</style>
@endsection
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Login</h2>
          <p>Login Here</p>
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
           
            <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
                @csrf
                <div class="form-group">
                    <label>Username </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Add User Name" value="{{ old('username') }}"/>
                    <div class="validate">
                        @error('username')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Password </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" />
                    <div class="validate">
                        @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-center"><button type="submit">Submit</button></div>
                <div class="text-center mt-3"><a href="{{ route('forgot.password') }}" class="">Forgot Password?</a></div>
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