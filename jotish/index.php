<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>JOTISHYA - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
    <?php include('includes/link.php'); ?>
</head>
<style>
    .spinner {

        animation-name: spin;
        animation-duration: 8000ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
        /* transform: rotate(3deg); */
        /* transform: rotate(0.3rad);/ */
        /* transform: rotate(3grad); */
        /* transform: rotate(.03turn);  */
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .spinner:hover {
        animation: none;
    }
    .spinner1 {

animation-name: spin;
animation-duration: 8000ms;
animation-iteration-count: infinite;
animation-timing-function: linear;
 position: absolute;
 left: 170px;
 top: 110px;
}

@keyframes spin {
from {
    transform: rotate(0deg);
}

to {
    transform: rotate(360deg);
}
}

.spinner1:hover {
animation: none;
}
    .about {
        background-color: #07273c;
    }

    .img {
        width: 85%;
        height: 90%;
        z-index: 1;
        float: right;
    }

    .aboutimg {
        width: 80%;
        height: 100%;
        background-color: #17384e;
        position: absolute;
        left: 50px;
        top: 50px;

        z-index: -1;

        /* box-shadow: -30px 30px #17384e;
      -moz-box-shadow: -30px 30px #17384e;
      -webkit-box-shadow: -50px 55px #17384e;
      -khtml-box-shadow: -50px 55px #17384e; */
    }

    .aboutimg1 {

        width: 90px;
        height: 90px;
        background-color: #17384e;
        position: absolute;
        left: 50px;
        bottom: -50px;
        border-left: 2px solid #ff4a17;
        border-bottom: 2px solid #ff4a17;
        z-index: -1;
        border-right-width: 20px;
    }

    .zodiac {
        background-color: #07273c;
    }

    ul {
        list-style-type: none;
    }

    .sign {

        width: 100%;
        height: 60px;
        background-color: #17384e;
        border-radius: 50px;
        margin: 30px;
    }

    .sign img {
        position: absolute;
        left: 17px;
        top: 3px;
        width: 55px;
    }
</style>

<body>
    <?php include('includes/navbar.php'); ?>


    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="fade-up" data-aos-delay="150">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="text-center mt-5 px-4" style="padding:65px">
                        <h1>Read your daily horoscope today</h1>
                        <h2 class="text-justify text-center">Know what’s in store for you ahead of the day for every sphere of your life, whether it’s your career, business, love, health or fashion.</h2>
                        <a href="#about" class="btn-get-started scrollto">Read more</a>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6 col-12 mt-5">
                    <img class="spinner" src="assets/image/horoscope.png" width="70%" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->


    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="" style="padding:0px 100px 0px 100px">
                    <h1 class="text-center text-white">About <span style="color:#ff4a17; font-weight:600"> Horoscope</span></h1>
                    <p class="text-justify text-center text-white">Horoscope, in astrology, a chart of the heavens, showing the relative positions of the Sun, the Moon, the planets, and the ascendant and midheaven signs of the zodiac at a specific moment in time. ... A horoscope is used to provide information about the present and to predict events to come.</p>
                </div>
                <div>
                    <div class="row">

                        <div class="col-lg-6 video-box align-self-baseline mt-5" data-aos="zoom-in" data-aos-delay="100">
                            <img class="img" src="assets/image/about.jpg" class="img-fluid" alt="">
                            <div class="aboutimg"></div>
                            <div class="aboutimg1"></div>
                            <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
                        </div>

                        <div class="col-lg-6 pt-3 pt-lg-0 content mt-5">
                            <div class="px-5 text-justify">
                                <h3 class="text-white"><u style="color: #ff4a17;">Horoscope revel the will of God</u></h3>
                                <p><i class="flaticon-airplane49"></i>
                                    Astrology is a pseudoscience that claims to divine information about human affairs and terrestrial events by studying the movements and relative positions of celestial objects. Astrology has been dated to at least the 2nd millennium BCE, and has its roots in calendrical systems used to predict seasonal shifts and to interpret celestial cycles as signs of divine communications.</p>
                                <p> Many cultures have attached importance to astronomical events, and some—such as the Hindus, Chinese, and the Maya—developed elaborate systems for predicting terrestrial events from celestial observations.
                                    Western astrology, one of the oldest astrological systems still in use, can trace its roots to 19th–17th century BCE Mesopotamia, from where it spread to Ancient Greece, Rome, the Arab world and eventually Central and Western Europe.</p>


                                <!-- <p>  Throughout most of its history, astrology was considered a scholarly tradition and was common in academic circles, often in close relation with astronomy, alchemy, meteorology, and medicine. It was present in political circles and is mentioned in various works of literature, from Dante Alighieri and Geoffrey Chaucer to William Shakespeare, Lope de Vega, and Calderón de la Barca. Following the end of the 19th century and the wide-scale adoption of the scientific method, researchers have successfully challenged astrology on both theoretical and experimental grounds, and have shown it to have no scientific validity or explanatory power.Astrology thus lost its academic and theoretical standing, and common belief in it has largely declined.[ -->
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
    </section>
    <!-- End About Section -->

    <section class="zodiac">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center m-4" style="padding:0px 100px 0px 100px">
                        <h1 class="text-center text-white">Choose <span style="color:#ff4a17; font-weight:600"> Zodiac sign</span></h1>
                        <p class="text-justify text-center text-white">A horoscope is used to provide information about the present and to predict events to come.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 ">
                    <ul>
                        <li>
                            <a class="" href="#">
                                <div class="sign">
                                    <div class="aries">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img src="assets/image/s1.png" class="img-fluid">
                                            </div>
                                            <div class="col-lg-8">
                                                <h5>Aries</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign">
                                    <div class="Taurus">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s2.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Taurus</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Gemini">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s3.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5> Gemini</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign">
                                    <div class="Cancer">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s4.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Cancer</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Leo">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s5.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Leo</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Vigro">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s6.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Vigro</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="col-lg-6 col-md-12 ">
                    <div class="text-center mt-5"> <img class="spinner1" src="assets/image/horoscope.png" width="60%" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 ">
                    <ul>
                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Libra">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s7.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Libra</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Scorpio">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s8.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Scorpio</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li> <a class="" href="#">
                                <div class="sign ">
                                    <div class="Sagittairus">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s9.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Sagittairus</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Capricorn">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s10.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Capricorn</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign ">
                                    <div class="Aquarius">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s11.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Aquarius</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a class="" href="#">
                                <div class="sign">
                                    <div class="Pisces">
                                        <div class="row">
                                            <div class="col-lg-4"><img src="assets/image/s12.png" class="img-fluid"></div>
                                            <div class="col-lg-8">
                                                <h5>Pisces</h5>
                                                <p>Mar 21 - Apr 19</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>

    </section>

    
<!-- our expert -->
  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
      <div class="container" data-aos="zoom-in">

        <div class="owl-carousel testimonials-carousel">

          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
            <h3>Saul Goodman</h3>
            <h4>Ceo &amp; Founder</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
            <h3>Sara Wilsson</h3>
            <h4>Designer</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
            <h3>Jena Karlis</h3>
            <h4>Store Owner</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->



    <?php include('includes/footer.php') ?>
    <?php include('includes/script.php') ?>


</body>