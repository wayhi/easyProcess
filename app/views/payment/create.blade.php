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
	
	<button class="btn btn-small btn-info" type="button">关联付款...</button>
	
	</div>
</div>	
	
       
        <div class="form-actions">
            {{ Form::submit('新增', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.pages.index') }}" class="btn btn-large">取消</a>
        </div>
</div>
    {{ Form::close() }}

@stop