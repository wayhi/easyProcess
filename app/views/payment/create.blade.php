@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
   <!-- @if ($errors->any())
            <div class="alert alert-error">
                    {{ implode('<br>', $errors->all()) }}
            </div>
    @endif
-->
	
    {{ Former::secure_open()->id('PaymentForm')->route('payment.store')->Method('POST')->class('form-inline')
    	->enctype('multipart/form-data')
    	->rules(array('Payee'=>'required',
    				'bank_info'=>'required',
    				'total_amount'=>'required|match:/[0-9.]+/',
    				'vat'=>'match:/[0-9.]+/',
    				'invoice_code'=>'match:/[a-zA-z0-9-_]+/',
    				'order_code'=>'match:/[a-zA-z0-9-_]+/',
    				'due_date'=>'after:2015-01-01',
    				'description'=>'required'
    				))
    
     }}
   
    <div class="container">
			
			<div class="row">
				<div class="span6">				
            		
            			
            			{{ Former::text('Payee')->class('span5')->id('Payee')->label('收款方：')->placeholder('收款方开户名称') }}
					
				</div>
					
				<div class="span6">
					
					{{ Former::text('bank_info')->class('span5')->id('bank')->label('银行账号：') }}
					
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
				{{ Former::text('total_amount')->class('span3')->id('total_amount')->label('总金额：')->prepend('￥') }}
				</div>
				<div class="span6">
					{{ Former::text('vat')->class('span3')->id('vat')->label('含增值税：')->prepend('￥') }}
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span6">
    
    	{{Former::checkbox('is_downpayment',false)->text('预付款')->unchecked_value('unchecked') }}
    	
    
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
			
			{{Former::select('cctr_'.$i,false)->options($cctr_options)}}
			
			
		</td>
		
		<td>
			{{Former::select('acct_'.$i,false)->options($acct_options)}}
		</td>
		
		<td>
			
				{{Former::text('amount_'.$i,false)->prepend('￥')->class('span2')}}
			
		</td>
	</tr>
	@endfor
	
	
	
	<tr>
		<td>
		
			{{ Former::submit('+')->class('btn btn-success btn-mini')->name('addrow') }}
			{{ Former::submit('-')->class('btn btn-info btn-mini')->name('delrow') }}
			
		</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
	</tbody>
	
</table>   
	
		<div class="row">
			<div class='span4'>
				{{ Former::text('invoice_code')->class('span3')->label('发票号码：')}}
			</div>
			<div class='span4'>
				{{ Former::text('order_number')->class('span3')->label('订单号码：')}}
			</div>
			<div class='span4'>
				{{ Former::date('due_date')->class('span3')->label('计划付款日期：')->placeholder('YYYY-MM-DD')}}
			</div>
		</div>
		<div class="row">
			<div class='span4'>
				{{ Former::textarea('description')->class('span3')->label('付款事由：')}}
			</div>
			<div class='span4'>
				{{ Former::textarea('memo')->class('span3')->label('备注：')}}
			</div>
			
			<div class='span4'>
				{{ Former::files('attachement')->class('span3')->label('上传附件 (< 2 MB)：')->max(2,'MB')}}
			</div>
		</div>
		
		<div class="row">
			
		</div>
		<div class="row"></div>


<div class="form-actions">

            {{ Former::submit('新增')->class('btn btn-success btn-save')->name('submit') }}
            <a href="{{ URL::route('admin.pages.index') }}" class="btn">取消</a>
        </div>

</div>



    {{ Former::close() }}

@stop