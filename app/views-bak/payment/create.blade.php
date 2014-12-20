@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
    @if ($errors->any())
            <div class="alert alert-error">
                    {{ implode('<br>', $errors->all()) }}
            </div>
    @endif


    {{ Former::open()->id('PaymentForm')
    				->Method('POST')->class('form-horizontal') 
    
     }}
    
    <div class="container">
			
			<div class="form-group">
				
				<div class="col-lg-6 col-md-6">	           			
            			{{ Former::text('Payee')->class('col-md-10')->id('Payee')->label('收款方：')}}
					<span class="glyphicon glyphicon-search"></span> 
					
				</div>
					
				<div class="col-lg-6 col-md-6">
					
						
            			{{ Former::text('银行账号：')->class('col-md-10')->id('bank') }}
            			
					
					
				</div>
			</div>
			
			<div class="form-group">
			
				<div class="col-lg-6 col-md-6">
					
					
					{{ Former::text('总金额：')->class('col-md-2')->id('total_amount')->prepend('￥') }}
					
				</div>
				
				<div class="col-lg-6 col-md-6">
					{{ Former::text('含增值税：')->class('col-md-6')->id('vat_amount') }}
				</div>
				
			</div>
			
 
	<div class="form-group">
 	<!--div class="col-md-6 col-lg-6">
   
    	{{Former::checkbox()->text('预付款')->id('is_downpayment')}}-->
    	<div class="col-md-offset-2 col-md-4">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
    
	</div>
	
	<div class="col-md-3 col-lg-3">
		<div class="control-group"><div class="controls">
		
			<a href="#" class="btn btn-primary btn-xs active" role="button">关联预付款...</a>
		</div></div>
	</div>
</div>	

<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td></td>
		<td>成本中心</td>
		<td>费用科目</td>
		<td>金额</td>
	</tr>
	</thead>
	
	<tbody>
	<tr>
		<td>1.</td>
		<td>{{Former::select()->id('cctr_1')->options($cctr_options)}}</td>
		
		<td>{{Former::select()->id('acct_1')->options($acct_options)}}</td>
		
		<td>
			{{Former::number()->id('amount_1')->class('col-lg-5')->prepend('￥')}}
		</td>
	</tr>
	<tr>
		<td>
			<button type="button" class="btn btn-primary btn-xs">
  			<span class="glyphicon glyphicon-user"></span> Add...
		</td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	</tbody>
	
	
		
		
	</div>
	
</table>   
	

<div class="form-actions">

            {{ Form::submit('新增', array('class' => 'btn btn-success btn-save')) }}
            <a href="{{ URL::route('admin.pages.index') }}" class="btn ">取消</a>
        </div>

</div>



    {{ Former::close() }}

@stop