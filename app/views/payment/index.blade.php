@extends('admin._layouts.default')

@section('main')

    {{ Notification::showAll() }}

    
<div class='container'>
    <table class="table">
        <thead>
            <tr >
                <th>申请单号<br> Requisition Code</th>
                <th>收款方 <br> Paid-to</th>
                <th>金额 <br> Total Amount</th>
                <th>类型 <br> Requisition Type</th>
                <th>提交时间 <br> Created</th>
                <th>状态 <br> Status</th>
                <th>操作<br> Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr @if($payment->status==1 or $payment->status==0 ) class=''
                @elseif($payment->status==2) class='success'
                @elseif($payment->status==3) class='info'
                @elseif($payment->status==-1) class='error'
                 @endif>

                    <td><a href="{{URL::Route('payment.show',Crypt::encrypt($payment->id))}}" 

                     data-toggle="tooltip" title="{{$payment->description}}">{{$payment->pmt_code }}</a> </td>
                    <td>{{$payment->vendor_name }}</td>
                    <td>{{$payment->amount}}</td>
                    <td>@if($payment->type==1)第三方付款
                    @elseif($payment->type==2)个人报销
                    @elseif($payment->type==-1)预付款
                    @else其他@endif</td>
                    
                    <td>{{$payment->created_at }}</td>
                    <td>@if($payment->status==0)保存中Ready
                    @elseif($payment->status==1)等待审批Pending
                    @elseif($payment->status==2)已批准Approved
                    @elseif($payment->status==3)已付款Paid
                    @elseif($payment->status==-1)已驳回Rejected
                    @endif</td>
                    
                    
                    <td>
                    	@if($payment->status==1)
							@if($payment->approvals[0]->status==1)
							 {{ Form::open(array('route' => array('payment.destroy', Crypt::encrypt($payment->id)), 
							 'method' => 'delete', 
							 'data-confirm' => 'Are you sure?')) }}
							 <button name='recall' type="submit"  class="btn-warning btn-small pull-left" value='recall'>撤回</button>
							{{Form::close()}}
							@endif
						@elseif($payment->status<=0)
							{{ Form::open(array('route' => array('payment.edit', Crypt::encrypt($payment->id)), 
							 'method' => 'get')) }}
							 <button name='edit' type='submit' class="btn-success btn-small pull-left">编辑</button>
							{{Form::close()}}
                        @endif
                       	
                    </td>
                    
                </tr>
            @endforeach
           
        </tbody>
        
        
    </table>
    
    <div class='pagination inline'>{{$payments->links();}}</div>
</div>
@stop