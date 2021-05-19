<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>AanaBusiness - Admin - @yield('title')</title>

    @include('admin.admin_layout.stylesheet')
    @yield('customcss')
</head>
<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>
    <div class="mobile-sticky-body-overlay"></div>
    <div class="wrapper">
      
        <!-- ==================================== ——— LEFT SIDEBAR WITH FOOTER ===================================== -->
        @include('admin.admin_layout.sidebar')

      

      <div class="page-wrapper">
                  <!-- Header -->
        @include('admin.admin_layout.topbar')


        <div class="content-wrapper">
            <div class="content">						 
                <!-- Top Statistics -->
                @yield('content')
            </div>
        </div>
        <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>&copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
        </footer>

      </div>
    </div>
    @include('admin.admin_layout.scripts')
    @yield('customjs')
</body>
</html>
