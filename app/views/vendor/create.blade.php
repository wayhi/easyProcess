@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
   <!-- @if ($errors->any())
            <div class="alert alert-error">
                    {{ implode('<br>', $errors->all()) }}
            </div>
    @endif
-->
	
    {{ Former::secure_open()->id('VendorForm')->route('vendor.store')->Method('POST')->class('form-inline')
    	
    
     }}
   
    <div class="container">
			
			<div class="row">
				<div class="span6">				
            		
            			
            			{{ Former::text('vendor_name')->class('span5')->label('供应商名称：') }}
					
				</div>
					
				<div class="span6">
					
					{{ Former::text('vendor_code')->class('span5')->label('供应商编号：') }}
					
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
				{{ Former::text('vendor_name_short')->class('span3')->label('简称：') }}
				</div>
				<div class="span6">
					{{ Former::text('address')->class('span3')->id('address')->label('地址：') }}
				</div>
				
			</div>
			
 <div class="row">
 	<div class="span6">
    
    	{{Former::text('contact')->label('联系人：')->class('span3') }}
    	
    
	</div>
	<div class="span6">
	
		{{Former::text('contact_tel')->label('联系方式：')->class('span3') }}
	
	</div>
</div>	
	<br>
<table id="payment-matrix" class="table">

	<thead> 
	<tr>
		<td>{{Former::text('bank_num')->type('hidden')->value($bank_num)}}</td>
		<td>开户银行名称   </td>
		<td>分支行</td>
		<td>账号</td>
		<td>银行编码</td>
		<td>SWIFT CODE</td>
	</tr>
	</thead>
	
	<tbody>
	@for ($i = 1; $i <= $bank_num; $i++)
    

	<tr>
		<td>{{$i}}</td>
		<td>
			
			{{Former::text('bank_name_'.$i,false)}}
			
			
		</td>
		
		<td>
			{{Former::text('branch_name_'.$i,false)}}
		</td>
		
		<td>
			
				{{Former::text('bank_account_'.$i,false)}}
			
		</td>
		<td>
			
				{{Former::text('bank_code_'.$i,false)}}
			
		</td>
		<td>
			
				{{Former::text('swift_code_'.$i,false)}}
			
		</td>
	</tr>
	@endfor
	
	
	
	<tr>
		<td colspan=2>
		
			{{ Former::submit('+')->class('btn btn-success btn-mini')->name('addrow') }}
			{{ Former::submit('-')->class('btn btn-info btn-mini')->name('delrow') }}
			
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	
	</tbody>
	
</table>   
	
		

<div class="form-actions">

            {{ Former::submit('新增')->class('btn btn-success btn-save')->name('submit') }}
            <a href="{{ URL::route('Nav.nav') }}" class="btn">取消</a>
        </div>

</div>



    {{ Form::close() }}

@stop