@extends('main')
@section('main')

{{Former::secure_open()->id('ExpenseForm')->route('reimburse.store')->Method('POST')->class('form-inline')}}
<h2 align='center'>个人报销</h2>

<table class='table'>
	<tbody>
		<tr><td>
		{{Former::select('exp_type',"费用类型-Expense Type:")->class('span2')->fromQuery(Expense::all(),'Description_CN','id')->select($expense_id)}}
	</td></tr>
	<tr><td>
		{{Former::date('exp_date',"费用日期-Transaction Date:")->class('span2')}}
	</td></tr>
	<tr><td>{{Former::select('exp_currency','币种-Currency:')->options([1=>'CNY',2=>'USD',3=>'HKD',4=>'JPY',5=>'GBP'],1)->class('span2')}}</td></tr>
	<tr><td>
		{{Former::text('exp_amount',"金额-Amount:")->class('span2')}}
	</td></tr>
	<tr><td>
		{{Former::text('exp_venue',"地点-Venue:")->class('span2')}}
	</td></tr>
	<tr><td>
		{{Former::textarea('exp_purpose',"用途-Purpose:")->class('span4')}}
	</td></tr>
	</tbody>
</table>	

<div align='center'>
				<div class="form-actions">
				
            		{{Former::submit('保存')->class('btn btn-success btn-small')->name('save')}}  
            		
					<a href="{{URL::route('reimburse.create')}}" class='btn btn-default btn-small'>返回</a>
					
				</div>
				
					
        	</div>

@stop