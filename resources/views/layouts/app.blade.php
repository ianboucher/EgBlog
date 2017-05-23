<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />

    <!-- Custom styles for this template -->
    <link href="../css/app.css" rel="stylesheet">
  </head>

  <body>

    @include('partials.nav')

    @if ($flash = session('message'))
        <div class="container">
            <div id="flash-message" class="alert alert-success" role="alert">
                {{ $flash }}
            </div>
        </div>
    @endif

    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">An example blog template built with Bootstrap.</p>
      </div>
    </div>

    <div id="app" class="container"> <!-- id="app" added for Vue.js -->

      <div class="row">

        <div class="col-sm-8 blog-main">
            @yield('content')
        </div>

        <div class="col-sm-3">
            @include('partials.sidebar')
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    @include('partials.footer')


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.9.4/umd/popper.min.js" integrity="sha256-KTKnuJPRS70XKLm+ka+irprJFaz/MLZQKHIID7ECCmw=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script> --}}
    <script src="../js/app.js"></script>
  </body>
</html>
