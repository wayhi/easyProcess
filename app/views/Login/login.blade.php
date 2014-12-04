<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess</title>

  @include('admin._partials.assets')

</head>
<body>

  
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
          
          {{ Form::text('email', '',array('placeholder' => '邮箱地址')) }}
        
        </div>
      </div>

      <div class="control-group">
        
        {{ Form::label('password', 'Password') }}
        
        <div class="controls">
          
          {{ Form::password('password', array('placeholder' => '密码')) }}
        
        </div>
        
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 记住我的登录
        </label>
      </div>

	  @if ($errors->has('login'))

        <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
      
      @endif


      
        
        {{ Form::submit('登录', array('class' => 'btn btn-success btn-login')) }}
        {{ Form::button('忘记密码？', array('class' => 'btn btn-warning')) }}
      
      



<hr>


	
	<div class="footer">
        <p>&copy; easyProcess.cn 2014</p>
      </div>
</div>
</body>
</html>