@extends('admin._layouts.default')

@section('main')

{{ Notification::showAll() }}
{{Former::secure_open()->id('PaymentApprovalList')->route('approval.store')->Method('post')->class('form-inline')}}
{{Former::submit('批准')->class('btn-success btn-small')->name('approve')}}   
{{Former::submit('驳回')->class('btn-danger btn-small')->name('reject')}} 
 
<hr>
<div class='container'>
    <table class="table">
        <thead>
            <tr>
                <th>{{Former::checkbox('pmt_chk_all','')}}</th>
                <th>收款方 <br> Paid-to</th>
                <th>金额 <br> Total Amount</th>
                <th>类型 <br> Requisition Type</th>
                <th>申请人<br>Applicant</th>
                <th>提交时间 <br> Created</th>
                <th>状态 <br> Status</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            	 @if($payment->status==1 or $payment->status==0 ) <tr class='warning'>
                @elseif($payment->status==2) <tr class='success'>
                @elseif($payment->status==3) <tr class='info'>
                @elseif($payment->status==-1) <tr class='error'>
                 @endif
                    <td><input type='checkbox' name='pmt_chk[]' value='{{Crypt::encrypt($payment->id)}}'></td>
                    <td><a href="{{URL::Route('approval.edit',Crypt::encrypt($payment->id))}}">{{$payment->vendor_name }}</a> </td>
                    <td>{{$payment->amount}}</td>
                    <td>@if($payment->type==1)第三方付款
                    @elseif($payment->type==2)个人报销
                    @elseif($payment->type==-1)预付款
                    @else其他@endif</td>
                    <td>{{$payment->creator->last_name}}</td>
                    <td>{{$payment->updated_at }}</td>
                    <td>@if($payment->status==0)保存中Ready
                    @elseif($payment->status==1)等待审批Pending
                    @elseif($payment->status==2)已批准Approved
                    @elseif($payment->status==3)已付款Paid
                    @elseif($payment->status==-1)已驳回Rejected
                    @endif</td>
                    
                    
                    
                </tr>
            @endforeach
           
        </tbody>
        
        
    </table>
    
    <div class='pagination inline'>{{$payments->links();}}</div>
</div>
{{Former::close()}}
@stop