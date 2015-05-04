
             
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>收款方 <br> Paid-to</th>
                <th>金额 <br> Total Amount</th>
                
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
                    <td><input type='checkbox' name='related_pmt_id' value='{{Crypt::encrypt($payment->id)}}'></td>
                    <td>{{$payment->vendor_name }}</td>
                    <td>{{$payment->amount}}</td>
                    
                    <td>{{$payment->created_at }}</td>
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

              
              
			