@extends('admin._layouts.default')
 
@section('main')
 	 
	<script src="{{ URL::asset('js/jQuery.FillOptions.js') }}"></script> 

 	
   

    
	<script>
		//$("#control_type").AddOption("请选择","-1",true,0);
		$(function(){
			$("#control_type").CascadingSelect( 
                $("#control_id"), 
                "/getApprovalSettings", 
                {textfield:"options",valuefiled:"id",parameter:"term"}, 
                function(){ 
                    $("#control_id").AddOption("请选择","-1",true,0);   
                } 
            ); 
		});
		
	</script>
    {{ Notification::showAll() }}
     
	
    {{ Former::secure_open()->id('ApprovalForm')->route('admin.approval.store')->Method('POST')->class('form-inline')    }}
   
    <div class="container">
			
		<div class="row">
				<div class="span4">
				{{ Former::select('control_type')->id('control_type')->class('span3')->label('审批类型：')
				->options(['1'=>'成本中心','2'=>'费用科目','3'=>'付款金额'])}}
				</div>
				<div class="span4">
					{{ Former::select('control_id')->id('control_id')->class('span3')->label('审批项：')->options($options) }}
				</div>
				
			</div>
			
		<div class="row">
				<div class="span4">
				{{ Former::select('authority_user')->class('span3')->label('审批人：')->options($user_options)}}
				</div>
				
				<div class="span4">
					{{ Former::text('approval_start')->class('span2')->id('approval_start')->label('审批金额下限:')->prepend('￥') }}
				</div>	
			
				<div class='span4'>
					{{ Former::text('approval_limit','')->class('span2')->id('approval_limit')->label('审批金额上限:')->prepend('￥') }}
				</div>
				
			</div>
			
 		<div class="row">
 			<div class="span4">
    
    	{{ Former::select('approval_level')->class('span3')->label('审批层级：')->inlineHelp('按层级从低到高审批')
    	->options(['1'=>'1','2'=>'2','3'=>'3','4'=>'4'])}}
    	
    	
	</div>
	
	
	<div class="span4"></div>
</div>

		<div class="row">	
	<div class="span4">
		
		{{Former::checkbox('mandatory',false)->text('固定审批人')}}
	
	
	</div>
	
	<div class="span4">
	
		{{Former::checkbox('activated',false)->text('有效')->check()}}
	
	</div>
		
</div>	

<div class="form-actions">

            {{ Former::submit('新增')->class('btn btn-success')->name('submit') }}
            {{ Former::submit('刷新')->class('btn btn-info')->name('refresh') }}
            <a href="{{ URL::route('Nav.nav') }}" class="btn">退出</a>
        </div>

  {{ Form::close() }}

	<hr>
<table id="approval-matrix" class="table">

	<thead> 
	<tr>
		
		<td>审批层级</td>
		<td>审批类型</td>
		<td>审批项目</td>
		<td>审批人</td>
		<td>审批金额下限</td>
		<td>审批金额上限</td>
		<td colspan="2">操作</td>
	</tr>
	</thead>
	
	<tbody>
	@if(Input::has('control_id'))
	@foreach($controls as $control)
    

	<tr>
		<td>{{{$control->approval_level}}}</td>
		@if($control->control_type_id==1)<td>成本中心</td>
		@elseif($control->control_type_id==2)<td>费用科目</td>
		@elseif($control->control_type_id==3)<td>付款金额</td>
		@else<td></td>
		@endif
		
		<td>{{{$options[$control->control_id]}}}</td>
		
		<td>{{{$control->user->last_name}}}</td>
		<td>{{$control->approval_start}}</td>
		<td>{{{$control->approval_limit}}}</td>
		<td colspan="2">
		
        {{ Former::open()->route('admin.approval.destroy',
        ['id'=>Crypt::encrypt($control->id),
        'control_type_id'=>$control->control_type_id,
        'control_id'=>$control->control_id])
        ->method('delete') }}
            <button type="submit"  class="btn btn-danger btn-mini">删除</button>
        {{ Former::close() }}
        <a hr
        
		</td>
	</tr>
	@endforeach
	@endif
	
	</tbody>
	
</table>   
	
		
</div>



  

@stop