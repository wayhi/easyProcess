<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>easyProcess</title>

  @include('admin._partials.assets')

</head>
<body>

    {{ Former::secure_open()->Method('POST')->route('register') }}

   <div class="container">   
   	<div class="row">
		<div class="span4">	
        
       
        <div class="control-group">
        
        	
        
        	<div class="controls">
        	{{ Form::label('email', 'Email') }}
        		<div class="input-prepend">
          <span class="add-on"><i class="icon-envelope"></i></span>
          {{ Form::text('email', '',array('placeholder' => '登录邮箱')) }}
        </div>
        	</div>
      	</div> 
        </div>
       

      <div class="span4">	
      
      	<div class="control-group">
        
        
        
        <div class="controls">
        {{ Form::label('password', 'Password') }}
        <div class="input-prepend">
          <span class="add-on"><i class="icon-lock"></i></span>
          {{ Form::password('password', array('placeholder' => '登录密码')) }}
        </div>
        </div>
        
       
      </div>
      
      </div>
        
        
        
    </div>
	
	  {{ Notification::showAll() }}


      
        
        {{ Form::submit('注册', array('class' => 'btn btn-success btn-login')) }}
        
      
      



<hr>

 
</div>
</body>
</html>