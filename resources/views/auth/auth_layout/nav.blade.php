<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.html">Aana Business</a></h1 >
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('about') }}">About</a></li>
          <li class="drop-down"><a href="#">Plan</a>
            <ul>
                <li><a href="{{ url('plan') }}">Aana Business Plan</a></li>
                <li><a href="{{ url('network') }}">Digital Network</a></li>
                  
            </ul>
          </li>
          <li><a href="{{ url('product') }}">Product</a></li>
          <!-- <li><a href="{{ url('contact') }}">Contact</a></li> -->
          <!-- <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a href="{{ url('contact') }}">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="{{ url('register') }}" class="get-started-btn">Register Now</a>
      <a href="{{ url('login') }}" class="get-started-btn">Login</a>
    </div>
  </header><!-- End Header -->