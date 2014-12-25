@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
    @if ($errors->any())
            <div class="alert alert-error">
                    {{ implode('<br>', $errors->all()) }}
            </div>
    @endif


    {{ Former::open()->id('PaymentForm')->route('payment.store')->Method('POST')->class('form-inline') }}
    
    <div class="container">
			
			<div class="row">
				<div class="span6">				
            		
            			
            			{{ Former::text('Payee')->class('span5')->id('Payee')->label('收款方：') }}
					
				</div>
					
				<div class="span6">
					
					{{ Former::text('bank')->class('span5')->id('bank')->label('银行账号：') }}
					
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
				{{ Former::text('total_amount')->class('span3')->id('total_amount')->label('总金额：')->prepend('￥') }}
				</div>
				<div class="span6">
					{{ Former::number('vat')->class('span3')->id('vat')->label('含增值税：')->prepend('￥') }}
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span6">
    
    	{{Former::checkbox()->text('预付款')->id('is_downpayment') }}
    	
    
	</div>
	<div class="span2">
	
	<button class="btn btn-small btn-info" type="button">关联预付款...</button>
	
	</div>
</div>	
	<br>
<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td>{{Former::text('row_count')->type('hidden')->value($row_count)}}</td>
		<td>成本中心</td>
		<td>费用科目</td>
		<td>金额</td>
	</tr>
	</thead>
	
	<tbody>
	@for ($i = 1; $i <= $row_count; $i++)
    

	<tr>
		<td>{{$i}}</td>
		<td>
			
			{{Former::select()->id('cctr_'.$i)->options($cctr_options)->select($cctr_1)}}
			
			
		</td>
		
		<td>
			{{Former::select()->id('acct_'.$i)->options($acct_options)}}
		</td>
		
		<td>
			
				{{Former::number()->id('amount_'.$i)->prepend('￥')->class('span2')}}
			
		</td>
	</tr>
	@endfor
	
	<tr>
		<td>
			{{ Former::open()->route('payment.edit',array('act'=>'addrow','row_count'=>$row_count))->method('post') }}
			{{ Former::submit('+')->class('btn btn-success btn-save btn-mini') }}
			{{ Former::close() }}
		</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
	</tbody>
	
</table>   
	

<div class="form-actions">

            {{ Former::submit('新增')->class('btn btn-success btn-save') }}
            <a href="{{ URL::route('admin.pages.index') }}" class="btn">取消</a>
        </div>

</div>



    {{ Form::close() }}

@stop