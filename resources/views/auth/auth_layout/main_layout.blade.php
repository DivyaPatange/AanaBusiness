<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Aana Business - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('auth.auth_layout.head')
  @yield('customecss')
</head>

<body>

    @include('auth.auth_layout.nav')

    <main id="main">
        @yield('content')
    </main>
 <!-- ======= Footer ======= -->
    @include('auth.auth_layout.footer')

<!-- Vendor JS Files -->
    @include('auth.auth_layout.script')
    @yield('customjs')
</body>

</html>

 


