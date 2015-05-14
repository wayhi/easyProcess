<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess</title>

  @include('admin._partials.assets')

</head>
<body>

  
  <div class="container">
  @yield('main')
  	

 	  <hr>
	     <div class="footer">
        <p>&copy; easyProcess.cn 2014</p>
      </div>
  </div>
<script src="{{ URL::asset('js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/local.js') }}"></script>
</body>
</html>