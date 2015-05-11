<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess</title>

  @include('admin._partials.assets')

</head>
<body>
<div class="container">
  <div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="{{ URL::route('Nav.nav') }}">easyProcess</a>

      @include('admin._partials.navigation')

    </div>
  </div>
</div>



  @yield('main')

</div>

<script src="{{ URL::asset('js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/local.js') }}"></script>

</body>
</html>