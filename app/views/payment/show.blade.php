@extends('admin._layouts.default')
 
@section('main')
 
    
    

    {{ Notification::showAll() }}
     
   
    <div class="container">
			
			<div class="row">
				<div class='span2'>
				</div>
				<div class="span4">				
            		
            			
            			
            			<h4>{{'<p class="text-info">收款方：</p>'.$payment->vendor_name}}</h4>
					
				</div>
					
				<div class="span4">
					
					<h4>{{'<p class="text-info">银行账号：</p>'.$payment->bank_info}}</h4>
					
				</div>
			</div>
			
			<div class="row">
			<div class='span2'>
				</div>
				<div class="span4">
				<h4>{{ '<p class="text-info">总金额： </p>'.$payment->amount }}</h4>
				</div>
				<div class="span4">
					<h4>{{ '<p class="text-info">含增值税： </p>'.$payment->vat }}</h4>
				</div>
				
			</div>
			
 	<br>
 	<div class='row'>
 		<div class='span2'>
				</div>
 		<div class='span8'>
			<table id="payment-matrix" class="table table-bordered">

				<thead> 
					<tr>
						<td></td>
						<td><p class="text-info">成本中心-Cost Center</p></td>
						<td><p class="text-info">费用科目-Account<p></td>
						<td><p class="text-info">金额-Amount</p></td>
					</tr>
					</thead>
	
					<tbody>
	
					@foreach($payment->allocations as $allocation)
	
	
					<tr>
						<td></td>
						<td>
							{{$cctr_options[$allocation->cctr_id]}}
			
			
			
						</td>
		
						<td>
							{{$acct_options[$allocation->acct_id]}}
						</td>
		
						<td>
			
							{{$allocation->amount_final}}	
			
						</td>
					</tr>
					@endforeach
	
					</tbody>
				</table>   
			</div>	
			
 		</div>
 		
 		<br>
		<div class="row">
		<div class='span2'>
				</div>
			<div class='span3'>
			
				{{ '<p class="text-info">发票号码-Invoice Code：</p>'.$payment->invoice_code}}
				
			</div>
			<div class='span3'>
			
				{{ '<p class="text-info">订单号码-PO：</p>'.$payment->order_number}}
				
			</div>
			<div class='span3'>
			
				{{ '<p class="text-info">计划付款日期-Due Date：</p>'.$payment->pmt_due_date}}
				
			</div>
		</div>
		<br>
		<div class="row">
		<div class='span2'>
				</div>
			<div class='span3'>
			
				{{ '<p class="text-info">付款事由-Purpose：</p>'.$payment->description}}
				
			</div>
			<div class='span3'>
			
				{{ '<p class="text-info">备注-Memo：</p>'.$payment->memo}}
				
			</div>
			
			<div class='span3'>
				@if($attachement_list!=[])
				{{'<p class="text-info">附件-Attachement(s)：</p>'.
				
				'<a href="'.array_dot($attachement_list[0])[1].'">'.array_dot($attachement_list[0])[0].'</a>'}}
				@endif
			</div>
			
		</div>
		<hr>
		<div class="row">
			<div class='span2'></div>
			
			<div class='span8'>
				<table class="table table-bordered">
					<caption>需要以下人员审批：</caption>
		<thead>
			<tr>
				<th></th>
				<th>审批人-Approver</th>
				<th>审批状态-Status</th>
				<th>审批意见-Comments</th>
			</tr>
		</thead>	
			
			
		<tbody>
			@foreach($payment->approvals as $approval)
			@if($approval->status==1)
			<tr class='warning'>
			@elseif($approval->status==2)
			<tr class='success'>
			@elseif($approval->status==-1)
			<tr class='error'>
			@endif
			<td>{{$approval->serial_no}}</td>
			<td>{{{$payment->approvers[$approval->serial_no-1]->last_name.
			'('.$payment->approvers[$approval->serial_no-1]->email.')'}}}</td>
			@if($approval->status==1)
			<td>审批中 Pending</td>
			@elseif($approval->status==2)
			<td>已批准 Approved</td>
			@elseif($approval->status==-1)
			<td>驳回 Rejected</td>
			@endif
			
			
			<td>{{$approval->comment}}</td>
			</tr>
			@endforeach
		</tbody>
	
				
				
				
				</table>
			
			</div>
				
		</div>
		<div class="row">
			<div class='span2'></div>
			<div class='span8'>

				<div class="form-actions">
            		<a href="{{ URL::route('payment.index') }}" class="btn btn-success">确定</a>
        		</div>
        		
        	</div>
        <div>

</div>





@stop