@extends('main')
@section('main')

<h2 align='center'>个人报销</h2>

<div class='row'>

	<div class='span3'>
		
			<a href="{{URL::route('reimbuse.create')}}"><span class="rounded rounded-green rounded-lg rounded-white-icon">
				<i class="fa fa-plus"></i><br>
				新的报销
			</span></a>
	</div>	
	<div class='span3'>	
		<b><< &nbsp &nbsp  	</b>
			<a href=""><span class="rounded rounded-orange rounded-lg rounded-white-icon">
				<div align='left' style="font-size: 11px;color: #fff">
				<br>	申请名称：<br>
				<br>	金额：<br>
				<br>	日期：<br>
				</div>
				<br>保存中
			</span></a>
	</div>		

	<div class='span3'>		
			<span class="rounded rounded-orange rounded-lg rounded-white-icon">
				<i class="fa fa-file-text-o"></i><br>
				
			</span>
	</div>			
	<div class='span3'>		
			<span class="rounded rounded-orange rounded-lg rounded-white-icon">
				<i class="fa fa-file-text-o"></i><br>	
			</span>
			<b>&nbsp &nbsp  >> </b>
	</div>			
		
</div>

<hr>
<div class='row'>

<table class="table n_table" >
	<thead>
		<tr>
		<th></th>	
		<th>已记录费用</th>
		<th>费用种类</th>
		<th>日期</th>
		<th>金额</th>
		</tr>	
	</thead>
	<tbody>
		<tr >
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>	


	</tbody>

</table>	

</div>
<div class='row'>
	<a type='button' class='btn btn-info btn-sm'>新的费用</a>
	<a type='button' class='btn btn-success btn-sm'>添加至新的申请</a>
	<a type='button' class='btn btn-success btn-sm'>添加至已有申请</a>
	<a type='button' class='btn btn-danger btn-sm'>删除费用</a>
</div>

@stop