@extends('auth.auth_layout.main_layout')
 @yield('title', 'Payment Success')
 @section('customcss')
    <style></style>
 @endsection
 @section('content')
 <!-- ======= About Section ======= -->
<section id="about" class="about">
<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">
        <div class="row content">
            <div class="col-lg-4">
                <img src="{{ asset('agreepay.png') }}" class="img-fluid mt-5" alt="">
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <div class="section-title">
                    <h2></h2>
                    <p>Thank You</p>
                </div>
                <div class="count-box">
                    <i class="icofont-dart"></i>
                    <!-- <i class="icofont-document-folder"></i> -->
                    <p>Thank You, Your payment was successful.</p>
                    <p><strong>Agreepay Transaction ID: </strong> 
                        {{ $paymentDetail->transaction_id }}
                    </p>
                    <p>You can now login with your <strong>Username</strong> and <strong>Password</strong> for further registration process.</p>
                <!-- <a href="#">Find out more &raquo;</a> -->
                </div>
            </div>
        </div>
    </div>
</section><!-- End About Section -->
</section>
    @endsection
  @section('customjs')
  <script></script>
  @endsection