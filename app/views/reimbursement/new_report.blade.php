@extends('main')
@section('main')

<h2 align='center'>个人报销</h2>

<div class='row'>

	<div class='span3'>
		<div class='box'>
			<span class="">
						<i class="fa fa-file-text-o"></i>
					</span>
					<h4><a href="{{URL::route('reimbuse.create')}}">个人报销</a><h4>
			
		</div>
	</div>	

</div>


@stop