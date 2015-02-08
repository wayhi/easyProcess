<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess</title>

  @include('admin._partials.assets')

</head>
<body>

  <!--section class="dark"-->
  <div class="container">
  
  <div class="jumbotron">
        <h1>企业支付审批系统</h1>
   </div>
   
   <hr>     
    
      <div id="login" class="login">

    {{ Form::open() }}

      
      <div class="control-group">
        
        {{ Form::label('email', 'Email') }}
        
        <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-envelope"></i></span>
         
          {{ Form::text('email', '',['placeholder' => '登录邮箱']) }}
        </div>
        </div>
      </div>

      <div class="control-group">
        
        {{ Form::label('password', 'Password') }}
        
        <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-lock"></i></span>
          {{ Form::password('password', array('placeholder' => '登录密码')) }}
        </div>
        </div>
        
        <label class="checkbox">
          <input type="checkbox" id='remember_me' name='remember_me' value='1'> 记住我的登录
          <a href="{{URL::route('reset_password')}}">忘记密码？</a>
        </label>
      </div>

	  @if ($errors->has('login'))

        <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
      
      @endif


      
        
        {{ Form::submit('登录', array('class' => 'btn btn-success btn-login')) }}
        
      
      



<hr>

 	
	<div class="footer">
        <p>&copy; easyProcess.cn 2014</p>
      </div>
</div>

</body>
</html>