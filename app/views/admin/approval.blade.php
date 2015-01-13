@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
	
    {{ Former::secure_open()->id('ApprovalForm')->route('approval.store')->Method('POST')->class('form-inline')    }}
   
    <div class="container">
			
			<div class="row">
				<div class="span6">				
            		
            		{{Former::select('control_type','审批控制类型')->options(['成本中心','费用科目','费用金额'])}}
            			
				</div>
					
				<div class="span6">
					{{Former::select('control_id',false)}}
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
				{{ Former::text('authority_user')->class('span3')->label('审批人：')}}
				</div>
				<div class="span6">
					{{ Former::text('approval_limit')->class('span3')->label('审批金额：')->prepend('￥') }}
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span4">
    
    	{{Former::checkbox('mandatory',false)->text('必须包括')}}
    	
	</div>
	
	<div class="span4">
		
		{{Former::select('approval_level',false)->text('必须包括')->option(['1','2','3','4','5','6','7','8','9'])}}
	
	
	</div>
	
	<div class="span4">
	
		{{Former::checkbox('activated',false)->text('有效')->check('checked')}}
	
	</div>
		
</div>	
	<br>
<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td>{{Former::text('row_count')->type('hidden')->value($row_count)}}</td>
		<td>控制类型</td>
		<td>控制项目</td>
		<td>审批人</td>
		<td>审批金额</td>
	</tr>
	</thead>
	
	<tbody>
	@for ($i = 1; $i <= $row_count; $i++)
    

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