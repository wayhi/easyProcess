@extends('main')
@section('main')

<h2 align='center'>个人报销</h2>

<div class='row'>

	<div class='span3'>
		
			<span class="rounded rounded-green rounded-lg rounded-white-icon">
				<i class="fa fa-plus"></i><br>
				<a style="font-size: 10px" href="{{URL::route('reimbuse.create')}}">新的报销</a>
			</span>
	</div>	
	<div class='span3'>	
		<< &nbsp &nbsp  	
			<span class="rounded rounded-orange rounded-lg rounded-white-icon">
				<i class="fa fa-file-text-o"></i><br>
				
			</span>
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
			&nbsp &nbsp  >>
	</div>			
		
	

</div>


@stop