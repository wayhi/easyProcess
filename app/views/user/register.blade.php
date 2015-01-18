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
	<div class="form-actions">
 	{{ Form::submit('注册', array('class' => 'btn btn-success btn-login')) }}
 	</div>
</div>
<HR>
{{Former::close()}}      
   
{{ Former::secure_open()->Method('POST')->route('userprofile') }}
	  
	<div class="container">  
	<div class='row'><p>{{Former::label('Profile Editing')}} </p></div> 
   		<div class="row">
			<div class="span4">	
				{{ Former::select('user_id')->class('span3')->label('用户：')->options($user_options)}} 
   			</div>
   		</div>	
   		<div class="row">
   		
			<div class="span4">	
				{{ Former::select('cctr_id')->class('span3')->label('成本中心 ：')->options($cctr_options)}} 
   			</div>
   			
   			<div class="span4">	
				{{ Former::select('approver_id')->class('span3')->label('直接审批者：')->options($user_options)}} 
   			</div>
   		</div>
	<div class="form-actions">
 	{{ Former::submit('更新')->class('btn btn-success btn-mini')->name('update') }}
 	{{ Former::submit('刷新')->class('btn btn-info btn-mini')->name('refresh')}}
 	</div>
 	
 </div>	
{{Former::close()}}


<hr>

</body>
</html>