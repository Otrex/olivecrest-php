
<div style='border:2px solid orange; padding: 20px; margin:20px;' >
	<div style="text-align: center;">
		<img style="height: 30px; width: auto;" src="https://362f11b13168.ngrok.io/img/logo6.png">
	</div>
	<div style="text-align: center;">
		<h1>You Made Payments of: </h1>
		<table border='1'>
			<th> Status </th><th> Currency </th><th> Amount </th><th> Confirmed At </th>
			<tr>
				<td> {{$data->status}} </td><td> {{$data->currency}} </td><td> {{$data->amount}} </td>
				<td> {{$data->confirmed_at}} </td>
			</tr>
		</table>
	</div>
	<div style="text-align: center; font-size: 12px;">
		{{ 'OliveC@contact_us' }}
	</div>
</div>