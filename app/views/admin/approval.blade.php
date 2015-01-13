@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
	
    {{ Former::secure_open()->id('ApprovalForm')->route('admin.approval.store')->Method('POST')->class('form-inline')    }}
   
    <div class="container">
			
			<div class="row">
				<div class="span6">
				{{ Former::select('control_type')->class('span3')->label('审批类型：')->options(['1'=>'成本中心','2'=>'费用科目','3'=>'付款金额'])}}
				</div>
				<div class="span6">
					{{ Former::select('control_id')->class('span3')->label('审批项：')->options($cctr_options) }}
				</div>
				
			</div>
			
			<div class="row">
				<div class="span6">
				{{ Former::select('authority_user')->class('span3')->label('审批人：')->options($user_options)}}
				</div>
				<div class="span6">
					{{ Former::text('approval_limit')->class('span3')->label('审批金额：')->prepend('￥') }}
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span4">
    
    	{{ Former::select('approval_level')->class('span3')->label('审批层级：')->options(['1'=>'1','2'=>'2','3'=>'3','4'=>'4'])}}
    	
    	
	</div>
	
	
	<div class="span4"></div>
</div>
<div class="row">	
	<div class="span4">
		
		{{Former::checkbox('mandatory',false)->text('固定审批人')}}
	
	
	</div>
	
	<div class="span4">
	
		{{Former::checkbox('activated',false)->text('有效')->check('checked')}}
	
	</div>
		
</div>	
	<br>
<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td></td>
		<td>控制类型</td>
		<td>控制项目</td>
		<td>审批人</td>
		<td>审批金额</td>
	</tr>
	</thead>
	
	<tbody>
	@for ($i = 1; $i <= 1; $i++)
    

	<tr>
		<td>{{$i}}</td>
		<td></td>
		
		<td></td>
		
		<td></td>
		<td></td>
	</tr>
	@endfor
	
	
	</tbody>
	
</table>   
	
		
<div class="form-actions">

            {{ Former::submit('新增')->class('btn btn-success btn-save')->name('submit') }}
            <a href="{{ URL::route('Nav.nav') }}" class="btn">取消</a>
        </div>

</div>



    {{ Form::close() }}

@stop