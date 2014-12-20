<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess.cn</title>

  @include('assets')

</head>
<body>
<div class="container">

  <div class="navbar navbar-default" role="navigation">

	<div class="container-fluid">
  <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::route('admin.pages.index') }}">easyProcess</a>
</div>
      @include('admin._partials.navigation')
</div>
</div>

<hr>

  @yield('main')

</div>
</body>
</html>