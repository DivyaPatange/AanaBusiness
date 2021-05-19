@extends('auth.auth_layout.main_layout')
 @yield('title', 'Index')
 
 @section('customcss')
    <style>
        p{
          font-size: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 @endsection
 @section('content')
 <!-- ======= Hero Section ======= -->
 <section id="hero">

    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide4.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Welcome to <br><span>Aana Business</span></h2>
               <p class="animate__animated animate__fadeInUp">आप आना बिज़नेस में ज्वाइन होते ही आप कोई भी चीज़ 25 %जमा कर के पूरी तरह से चीजे  ख़रीदी कर सकते हैं, बाक़ी 75 % माफ़(Discount) 
                                            आना बिज़नेस मे सामील लोगों को         50,000-10 लाख तक का क्रेडिट लोन ले सकते हैं (NO CIBIL required ) </p> 
              <!--<a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>-->
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide5.jpg)">
          <div class="carousel-container">
            <div class="container">
               <h2 class="animate__animated animate__fadeInDown">Welcome to <br><span>Aana Business</span></h2> 
               <p class="animate__animated animate__fadeInUp">Only PAN Card , Adhar card , cancel chaqu is required.</p> 
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide6.jpg)">
          <div class="carousel-container">
            <div class="container">
               <h2 class="animate__animated animate__fadeInDown">Welcome to <br><span>Aana Business</span></h2>
              <p class="animate__animated animate__fadeInUp">आप आना बिज़नेस के मेंबर बनते ही सीमित अवधि तक बिज़नेस करने का सुनहरा मौक़ा आप को मिलता है जिसमें आप अनगिनतलाखों करोड़ों रक़म कमा सकते हो 
                                            आप आना बिज़नस के समूह के किसी भी प्रोडक्ट में शेयर पार्टनर बन सकते हैं 
                                            आना बिज़नेस में Join होकर अपने सपनों की दुनिया को हक़ीक़त में सजाए</p> 
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>
  </section><!-- End Hero -->
  <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Introduction</h2>
          <p>Introduction</p>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <img src="assets/img/i1.jpeg" width="100%" height="250px">
            <!-- <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul> -->
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
              Welcome all of you to India's fastest growing Product Management Company. 
              The Aana Business provides you a miraculous opportunity for your bright and safe future. 
            </p>
            <p>
            We have a team of dedicated and committed professionals having vast experience in business.<br>It is totally house hold product based business.          
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
     <!-- ======= Counts Section ======= -->
     <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">

          <div class="col-lg-4 col-md-4 d-md-flex align-items-md-stretch">
            <div class="count-box">
            <i class="icofont-eye-alt"></i>
              <!-- <i class="icofont-simple-smile"></i> -->
             
              <h4>Our Vision</h4>
              <p class="text-justify"><strong>Our Vision</strong> 
                is to produce creative professional in the field of business management industry "Aana Business" provide you powerful platform & to provide them best environment to act and achieve big as well as to create your present and future to bring happiness in your life.
              </p>
              <!-- <a href="#">Find out more &raquo;</a> -->
            </div>
          </div>

         

          <div class="col-lg-4 col-md-4 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <!-- <i class="icofont-live-support"></i> -->
              <i class="icofont-hand-power"></i>
              <h4>Our Motto</h4>
              <p><strong>Trees</strong> 
                are vital for this planet as they give us oxygen, absorb carbon dioxide, stabilize the soil and gve life to the world's wildlife. They also provide us with the material for tools and shelter. Despite their importance, human beings are cutting them down for their worldly needs. This has to be minimized because our life is not possible without trees. Instead or cutting them, we should grow more trees.
              </p>
              <!-- <a href="#">Find out more &raquo;</a> -->
            </div>
          </div>
          <div class="col-lg-4 col-md-4 d-md-flex align-items-md-stretch">
            <div class="count-box">
            <i class="icofont-dart"></i>
              <!-- <i class="icofont-document-folder"></i> -->
              <h4>Our Mission</h4>
              <p><strong>Our Mission</strong> 
                is to protect, plant, cultivate and promote trees, conservation of trees, forests, associated biodiversity and indigenous knowledge about the wise and sustainable use of trees, plants, soil, water, and other natural resources advocacy and promotion of public awareness of both local and global environmrntal and socio-economic issues created by deforestation and unsustainable agriculture and the potential of trees to rehabilitate degraded land, generate livelihood benefits and combat climate change.
              </p>
              <!-- <a href="#">Find out more &raquo;</a> -->
            </div>
          </div>
          <!-- <div class="col-lg-4 col-md-4 d-md-flex align-items-md-stretch">
            <div class="count-box"> -->
              <!-- <i class="icofont-users-alt-5"></i> -->
              <!-- <i class="icofont-handshake-deal"></i>
              <h4>Strategy</h4> -->
              <!-- led action  to protect, restore and care for the environment and sustain livelihood in response to deforestation, degradation and climate shocks. -->
              <!-- <p>
                <strong>Our new Growing Together Strategy</strong>
                   is first and foremost a reflection of growing community. 
                   <br><strong> Education:</strong> Foster an understanding of the amenity, ecological and economic value of trees. 
                   <br><strong>Livelihoods: </strong> Enable communities to develop and restore sustainable and productive landscapes through tree cultivation. 
                   <br><strong>Environment: </strong> Increase tree cover, promote reforestation and appropriate tree cultivation.
              </p>
              <a href="#">Find out more &raquo;</a>
            </div> -->
          <!-- </div> -->

        </div>


      </div>
    </section>
    <!-- End Counts Section -->
  @endsection
  
  <!--model section-->
     <!--pop up model box-->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" style="color:#012970;">
                            <b>Aana Business</b>
                        </h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!--<h4></h4>-->
                        <div class="container">
                            <div class="row py-3">
                                <div class="col-md-12 col-lg-12 col-12">
                                    <div class="text-light p-3 mb-2" style="background-color:#ed502e;">
                                        <p>
                                            आप आना बिज़नेस में ज्वाइन होते ही आप कोई भी चीज़ 25 %जमा कर के पूरी तरह से चीजे  ख़रीदी कर सकते हैं, बाक़ी 75 % माफ़(Discount) 
                                            आना बिज़नेस मे सामील लोगों को         50,000-10 लाख तक का क्रेडिट लोन ले सकते हैं (NO CIBIL required ) 
                                        </p>
                                        <p>
                                            Only PAN Card , Adhar card , cancel chaqu is required.
                                        </p>
                                        <p>
                                            आप आना बिज़नेस के मेंबर बनते ही सीमित अवधि तक बिज़नेस करने का सुनहरा मौक़ा आप को मिलता है जिसमें आप अनगिनतलाखों करोड़ों रक़म कमा सकते हो 
                                            आप आना बिज़नस के समूह के किसी भी प्रोडक्ट में शेयर पार्टनर बन सकते हैं 
                                            आना बिज़नेस में Join होकर अपने सपनों की दुनिया को हक़ीक़त में सजाए
                                        </p>
                                    </div>
                                    <!--<form>-->
                                    <!--    <div class="form-group">-->
                                    <!--        <input type="text" class="form-control" placeholder="Name">-->
                                    <!--    </div>-->
                                    <!--    <div class="form-group">-->
                                    <!--        <input type="email" class="form-control" placeholder="Email Address">-->
                                    <!--    </div>-->
                                    <!--    <button type="submit" class="btn btn-primary">Subscribe</button>-->
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--//modelbox-->
 <!--//pop up model section-->
 
  @section('customjs')
   <!--for model-->
      <!--<script>-->
      <!--  $(document).ready(function(){-->
      <!--    $("#myModal").modal('show');-->
      <!--  });-->
      <!--</script>-->
      
      <!--//for model-->
  @endsection