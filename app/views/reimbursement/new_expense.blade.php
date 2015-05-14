<table class='table'>
	<tbody>

		@foreach($exp_group as $group)
		<tr>
			<td>{{$group->Description_CN}}</td>
			<td>
				@foreach($group->expenses as $expense)
					{{$expense->Description_CN}}
				@endforeach

			</td>	

		</tr>
		@endforeach

	</tbody>




</table>