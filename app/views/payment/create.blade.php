@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
    @if ($errors->any())
            <div class="alert alert-error">
                    {{ implode('<br>', $errors->all()) }}
            </div>
    @endif


    {{ Form::open(array('route' => 'payment.store')) }}
    
    <div class="container">
			
			<div class="row">
				<div class="span6">
					
					<div class="control-group">
					
            			<h4>收款方：</h4>
            			{{ Form::text('title', '', array('class' => 'span5')) }}
					</div>
					
				</div>
					
				<div class="span6">
					<div class="control-group">
						<h4>银行账号：</h4>
            			{{ Form::text('bank', '', array('class' => 'span5')) }}
					</div>
					
				</div>
			</div>
			
			<div class="row">
			
				<div class="span6">
					<div class="control-group">
					<h4>总金额：</h4>
					{{ Form::text('amount', '', array('class' => 'span3')) }}
					</div>
				</div>
				
				<div class="span6">
					<div class="control-group">
					<h4>含增值税：</h4>
					{{ Form::text('vat', '', array('class' => 'span3')) }}
					</div>
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span6">
    <label class="checkbox">
    	{{Form::checkbox('is_downpayment','') }}
    	预付款
    </label>    
	</div>
	<div class="span2">
	
	<button class="btn btn-small btn-info" type="button">关联预付款...</button>
	
	</div>
</div>	
	<br>
<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td>#</td>
		<td>成本中心</td>
		<td>费用科目</td>
		<td>金额</td>
	</tr>
	</thead>
	
	<tbody>
	<tr>
		<td>1.</td>
		<td>
			
			{{Form::select('cctr_1', array('1' => '420000','2'=>'420010')) }}
			
			
			
			
		</td>
		
		<td>
			{{Form::text('acct_1','')}}
		</td>
		
		<td>
			<div class="input-prepend">
				<span class="add-on">¥</span>
				{{Form::number('amount_1','0.00',array('class'=>'span2'))}}
			</div>
		</td>
	</tr>
	</tbody>
	
</table>   
	
<<<<<<< Updated upstream
       

    


        <div class="form-actions">
=======
<div class="form-actions">
>>>>>>> Stashed changes
            {{ Form::submit('新增', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.pages.index') }}" class="btn btn-large">取消</a>
        </div>

</div>



    {{ Form::close() }}

@stop