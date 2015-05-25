<table class='table'>
	<tbody>

		@foreach($exp_groups as $group)
		<tr>
			<td>{{$group->Description_CN}}</td>
			<td>
				@foreach($group->expenses as $expense)
					<a href="{{URL::route('reimburse.expense_input',['expense_id'=>$expense->id])}}" >{{$expense->Description_CN}}</a>
				@endforeach

			</td>	

		</tr>
		@endforeach

	</tbody>




</table>