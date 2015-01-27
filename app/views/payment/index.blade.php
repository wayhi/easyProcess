@extends('admin._layouts.default')

@section('main')

    {{ Notification::showAll() }}

    
<div class='container'>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>收款方 <br> Paid-to</th>
                <th>金额 <br> Total Amount</th>
                <th>类型 <br> Requisition Type</th>
                <th>提交时间 <br> Created</th>
                <th>状态 <br> Status</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr @if($payment->status==1 or $payment->status==0 ) class='warning'
                @elseif($payment->status==2) class='success'
                @elseif($payment->status==3) class='info'
                @elseif($payment->status==-1) class='error'
                 @endif>
                    <td>{{$payment->id }}</td>
                    <td><a href="{{URL::Route('payment.show',Crypt::encrypt($payment->id))}}">{{$payment->vendor_name }}</a> </td>
                    <td>{{$payment->amount}}</td>
                    <td>@if($payment->type==1)第三方付款
                    @elseif($payment->type==2)个人报销
                    @else其他@endif</td>
                    <td>{{$payment->updated_at }}</td>
                    <td>@if($payment->status==0)准备中Ready
                    @elseif($payment->status==1)等待审批Pending Approval
                    @elseif($payment->status==2)已批准Approved
                    @elseif($payment->status==3)已付款Paid
                    @elseif($payment->status==-1)已驳回Rejected
                    @endif</td>
                    
                    
                    <td>
                    
                    	@if($payment->approvals[0]->status==1)
                        <a href="" class="btn btn-warning btn-mini pull-left">召回Recall</a>
                        @endif
                       
                    </td>
                    
                </tr>
            @endforeach
           
        </tbody>
        
        
    </table>
    
    <div class='pagination inline'>{{$payments->links();}}</div>
</div>
@stop