@extends('admin._layouts.default')

@section('main')
 <script src="{{URL::asset('js/Chart.min.js')}}"> </script>  
    <!-- Modal -->
<script>

$("#myModal").on("show",function(){
	
       $(this).find('.modal-body').css({
              width:'800px', //probably not needed
              height:'800px', //probably not needed 
              'max-height':'100%'
       });


});

$("#myModal_approve").on("show",function(){
	
       $(this).find('.modal-body').css({
              width:'800px', //probably not needed
              height:'800px', //probably not needed 
              'max-height':'100%'
       });


});
function loadchart(){

			var data = {
		labels: ["YTD", "Full Year"],
		
		datasets: [
			{
				label: "实际发生-Actual(千人民币)",
				fillColor: "rgba(220,220,220,0.5)",
				strokeColor: "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				{{$actual[0]}}
			},
			{
				label: "预算-Budget(千人民币)",
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				{{$budget[0]}}
			}
		]
	};

			var ctx = $("#myChart").get(0).getContext("2d");

			var myChart = new Chart(ctx).Bar(data,{
				  legendTemplate : "<ul>"
                  +"<% for (var i=0; i<datasets.length; i++) { %>"
                    +"<li>"
                    +"<span style='background-color: <%=datasets[i].fillColor %>'>"
                    +"<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>"
                  +"</span></li>"
                +"<% } %>"
              +"</ul>",
				  
				
				  
				 
			});
			
			document.getElementById("legendDiv").innerHTML = myChart.generateLegend();
   
};

</script>
     <h2 align='center'>付款申请单</h2>
    <hr>

    {{ Notification::showAll() }}
{{Former::secure_open()->id('PaymentApprovalForm')->route('approval.update',Crypt::encrypt($payment->id))->Method('put')->class('form-inline')}}

   
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
			
 	<hr>
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
					<tr>
					<td></td>	
					<td colspan=3> 
					<button type='button' onclick="loadchart();$('#myModal').modal('show')" class="btn btn-small btn-info">Actual vs. Budget...</button>
					</td>
					</tr>
					</tbody>
				</table>   
			</div>	
			
 		</div>
 		<!--  modal content start-->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel">Actual vs. Budget：</h3>
            </div>
            <div class="modal-body">
            <div id="legendDiv"></div>
            <canvas id="myChart" width="500" height="300"></canvas>
            
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-small" data-dismiss="modal">确定</button>
              
            
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
			
			@if($payment->reviewer_id == $approval->approver_id)
			<td>{{Former::textarea('comment','')->value($approval->comment)->rows(3)->columns(10)}}</td>
			@else
			<td>{{{$approval->comment}}}</td>
			@endif
			</tr>
			@endforeach
		</tbody>
	
				
				
				
				</table>
			
			</div>
				
		</div>
		
		<div class="row">
			<div class='span2'>
			</div>
			
			
			<div class='span8'>
				<div class="form-actions">
				
            		{{Former::submit('批准')->class('btn-success btn-small')->name('approve')}}  
            		<a href="#myModal_approve"  data-toggle="modal" class="btn btn-primary btn-small">批准并抄送...</a>
					{{Former::submit('驳回')->class('btn-danger btn-small')->name('reject')}} 
					
				</div>
				
					
        	</div>
        	
					
			<!--  modal content start-->
          	<div id="myModal_approve" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModal_approveLabel" aria-hidden="true">
	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	              <h3 id="myModal_approveLabel">选择需要抄送的人员：</h3>
	            </div>
	            <div class="modal-body">
	              
	              {{ Former::select('approver_id[]')->multiple()->label('增加审批者：')->options(User::activated()->whereNotIn('id',$payment->approvers->lists('id'))
	              ->where('id','<>',$payment->created_by_user)->orderBy('last_name')->lists('last_name','id'))}} 
	              
	              
				</div>
	            <div class="modal-footer">
	              <button class="btn" data-dismiss="modal">关闭</button>
	              
	              <input class="btn btn-success" type='submit' name='approve_forward' value='批准'>
	              
	            
	            </div>
	        </div>
  			<!--Modal content end -->
        	 </div>
		
		
</div>
{{Former::close();}}
@stop