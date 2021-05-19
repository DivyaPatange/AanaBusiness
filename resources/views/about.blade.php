@extends('auth.auth_layout.main_layout')
 @yield('title', 'about')
 @section('customcss')
    <style></style>
 @endsection
 @section('content')
 <!-- ======= About Section ======= -->
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p>About Us</p>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Aana Business the toatally household products based business.</p>
              <p>
                <strong>Our new Growing Together Strategy</strong>
                   is first and foremost a reflection of growing community.     
            </p>
            <p>
            Our Strategy led action  to protect, restore and care for the environment and sustain livelihood in response to deforestation, degradation and climate shocks. 
            </p>
           
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
          <ul>
              <li><i class="ri-check-double-line"></i> <strong> Education:</strong> Foster an understanding of the amenity, ecological and economic value of trees. </li>
              <li><i class="ri-check-double-line"></i><strong>Livelihoods: </strong> Enable communities to develop and restore sustainable and productive landscapes through tree cultivation. </li>
              <li><i class="ri-check-double-line"></i><strong>Environment: </strong> Increase tree cover, promote reforestation and appropriate tree cultivation.</li>
            </ul>
            
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
    @endsection
  @section('customjs')
  <script></script>
  @endsection