@extends('auth.auth_layout.main_layout')
@yield('title', 'Products')
@section('customcss')
<style></style>
@endsection
@section('content')
     <!-- ======= Services Section ======= -->
     <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Products</h2>
          <p>Check our Products</p>
        </div>
        <div class="row mb-3">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-8 col-md-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <video width="600px" height="280" controls>
                  <source src="assets/img/Video.mp4" type="video/mp4">
                  
                  Your browser does not support the video tag.
                </video>
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>
        <div class="row mt-3 pt-3">
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <!-- <div class="icon"> -->
                <!-- <i class="bx bxl-dribbble"></i> -->
                
            <!-- </div> -->
            <img src="assets\img\pic2.PNG" width="100%" height="200px">
              <!-- <h4><a href="">Products</a></h4> -->
              <!-- <p>Products</p> -->
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <!-- <div class="icon"><i class="bx bx-file"></i></div> -->
              <!-- <h4><a href="">Sed ut perspiciatis</a></h4> -->
              <img src="assets\img\pic1.PNG" width="350px" height="200px">
              <!-- <p>Product </p> -->
            </div>
          </div>

          <!--<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">-->
          <!--  <div class="icon-box">-->
              <!-- <div class="icon"><i class="bx bx-tachometer"></i></div>
          <!--    <h4><a href="">Magni Dolores</a></h4> -->
          <!--    <img src="assets\img\p3.png" width="100%" height="200px">-->
              <!-- <p>Product</p> -->
          <!--  </div>-->
          <!--</div>-->

          <!--<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">-->
          <!--  <div class="icon-box">-->
              <!-- <div class="icon"><i class="bx bx-world"></i></div>
          <!--    <h4><a href="">Nemo Enim</a></h4> -->
          <!--    <img src="assets\img\p4.jpg" width="100%" height="200px">-->
              <!-- <p>Product</p> -->
          <!--  </div>-->
          <!--</div>-->

          <!--<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">-->
          <!--  <div class="icon-box">-->
              <!-- <div class="icon"><i class="bx bx-slideshow"></i></div>
          <!--    <h4><a href="">Dele cardo</a></h4> -->
          <!--    <img src="assets\img\p5.jpg" width="100%" height="200px">-->
              <!-- <p>Product</p> -->
          <!--  </div>-->
          <!--</div>-->

          <!--<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">-->
          <!--  <div class="icon-box">-->
              <!-- <div class="icon"><i class="bx bx-arch"></i></div> -->
              <!-- <h4><a href="">Divera don</a></h4> -->
          <!--    <img src="assets\img\p6.jpg" width="100%" height="200px">-->
              <!-- <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p> -->
          <!--  </div>-->
          <!--</div>-->

        </div>

      </div>
    </section><!-- End product Section -->

@endsection
  @section('customjs')
  <script></script>
  @endsection