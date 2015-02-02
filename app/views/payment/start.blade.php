@extends('admin._layouts.default')
 
@section('main')
 
    <!--link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"-->
 

    {{ Notification::showAll() }}
     
 	
    {{ Former::secure_open()->id('VendorForm')->route('payment.create')->Method('POST')->class('form-inline')
    	
    
     }}
   
    <div class="container">
			
			<div class="row">
				<div class="span6">				
            		
            			
            			{{ Former::text('vendor_name')->class('span5')->label('供应商名称：')->placeholder('输入名称关键字或供应商编号查询') }}
					
				</div>
					
				<div class="span6">
					
					{{ Former::text('bank_info')->class('span5')->label('银行账号信息：') }}
					
				</div>
			</div>
			
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			<div class='row'><br></div>
			
		<div class="form-actions">

            {{ Former::submit('下一步')->class('btn btn-success')->name('submit') }}
            <a href="{{ URL::route('Nav.nav') }}" class="btn">返回</a>
            
		</div>

</div>



    {{ Former::close() }}

@stop