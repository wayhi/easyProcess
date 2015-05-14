<table class='table'>
	<tbody>

		@foreach($exp_groups as $group)
		<tr>
			<td>{{$group->Description_CN}}</td>
			<td>
				@foreach($group->expenses as $expense)
					<a href='#'>{{$expense->Description_CN}}</a>
				@endforeach

			</td>	

		</tr>
		@endforeach

	</tbody>




</table>