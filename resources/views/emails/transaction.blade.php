
<div style='border:2px solid orange; padding: 20px; margin:20px;' >
	<div style="text-align: center;">
		<img style="height: 30px; width: auto;" src="https://362f11b13168.ngrok.io/img/logo6.png">
	</div>
	<div style="text-align: center;">
		<h1> Thank You For Choosing Us </h1>
		<h1> {{ $details->firstname }} </h1>
		<h2> You have Performed the transaction: </h2>
		<table border="1">
			<tr><td><b> Type </b></td><td> {{ $details->type }} </td></tr>
			<tr><td><b> Status </b></td><td> {{ $details->status }} </td></tr>
			<tr><td><b> Amount </b></td><td> {{ $details->amount }}</td></tr>
			<tr><td><b> Currency </b></td><td> {{ $details->currency }}</td></tr>
		</table>

		<p> Visit : <u><b>{{ $details->url }}{{ $details->token }}</b></u> To verify your account. </p>
		<p > Or click <a href='{{$details->url}}{{$details->token}}' style="display: inline-block; background-color: orange; padding: 5px;" > Verify </a> To verify. </p>
	</div>
	<div style="text-align: center; font-size: 12px;">
		{{ 'OliveC@contact_us' }}
	</div>
</div>