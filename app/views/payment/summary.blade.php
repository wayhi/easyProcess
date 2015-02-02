@extends('admin._layouts.default')
 
@section('main')

{{Notification::showAll()}}


{{Debugbar::info($payment)}}
<div class='container'>

	<div class='row'>
		<div class='span3'>
		</div>
		<div class='span6'>
			<h3>申请单号：{{$payment->id}}</h3>
			
		</div>
		<div class='span3'>
		</div>
	</div>
	<div class = 'row'>	
		<div class='span3'>
		</div>
		<div class='span6'>
			<h3>付至：{{$payment->payee->vendor_name}}</h3>
			
		</div>
		<div class='span3'>
		</div>
	</div>
	
	<div class='row'>
		<div class='span3'>
		</div>
		<div class='span6'>
			<h3>付款金额:  {{$payment->amount}}</h3>
			
		</div>
		<div class='span3'>
		</div>
	</div>
	
	<div class='row'>
		<div class='span3'>
		</div>
		<div class='span6'>
			<h3>付款事由：</h3><br>
			{{{$payment->description}}}
			
		</div>
		<div class='span3'>
		</div>
	</div>
	<HR>
	<div class='row'>
		<div class='span3'>
		</div>
		<div class='span6'>
	<table class='table table-bordered'>
	<caption>需要以下人员审批：</caption>
		<thead>
			<tr>
				<th></th>
				<th>审批人</th>
				<th>状态</th>
			</tr>
		</thead>	
			
			
		<tbody>
			@foreach($payment->approvers as $approver)
			
			<tr class='warning'>
			<td></td>
			<td>{{{$approver->last_name.'('.$approver->email.')'}}}</td>
			<td>Pending</td>
			</tr>
			@endforeach
		</tbody>
	
	</table>
	</div>
		<div class='span3'>
		</div>
	</div>	
</div>

<div class="form-actions">

            
            <a href="{{ URL::route('Nav.nav') }}" class="btn btn-success">确定</a>
            
        </div>
@stop	
 
 