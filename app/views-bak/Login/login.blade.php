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
        <h2>企业支付审批系统</h2>
   </div>
   
   <hr>     
    
      <div id="login" class="login">

    {{ Form::open() }}

      
      <div class="control-group">
        
        {{ Form::label('email', 'Email') }}
        
        <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-envelope"></i></span>
          {{ Form::text('email', '',array('placeholder' => '邮箱地址')) }}
        </div>
        </div>
      </div>

      <div class="control-group">
        
        {{ Form::label('password', 'Password') }}
        
        <div class="controls">
          
          {{ Form::password('password', array('placeholder' => '密码')) }}
        
        </div>
        
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 记住我的登录
          <a href="">忘记密码？</a>
        </label>
      </div>

	  @if ($errors->has('login'))

        <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
      
      @endif


      
        
        {{ Form::submit('登录', array('class' => 'btn btn-success btn-login')) }}
        
      
      



<hr>

 <!--div class="text-center">
              <a class="quick-btn" href="#">
                <i class="fa fa-bolt fa-2x"></i>
                <span>default</span> 
                <span class="label label-default">2</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-check fa-2x"></i>
                <span>danger</span> 
                <span class="label label-danger">2</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-building-o fa-2x"></i>
                <span>No Label</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-envelope fa-2x"></i>
                <span>success</span> 
                <span class="label label-success">-456</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-signal fa-2x"></i>
                <span>warning</span> 
                <span class="label label-warning">+25</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-external-link fa-2x"></i>
                <span>π</span> 
                <span class="label btn-metis-2">3.14159265</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-lemon-o fa-2x"></i>
                <span>é</span> 
                <span class="label btn-metis-4">2.71828</span> 
              </a> 
              <a class="quick-btn" href="#">
                <i class="fa fa-glass fa-2x"></i>
                <span>φ</span> 
                <span class="label btn-metis-3">1.618</span> 
              </a> 
            </div --!>
	
	<div class="footer">
        <p>&copy; easyProcess.cn 2014</p>
      </div>
</div>
</body>
</html>