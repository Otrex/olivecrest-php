
<div style='border:2px solid orange;' >
	<div style="text-align: center;">
		<img style="height: 30px; width: auto;" src="/img/logo6.png">
	</div>
	<h1> Thank You For CHoosing Us </h1>
	<h1> {{ $details->firstname }} </h1>
	<h2> We hope to give you a spendid experience </h2>

	<p> Visit : <u><b>{{ $details->url }}{{ $details->token }}</b></u> To verify your account. </p>
	<p > Or click <a href='{{$details->url}}{{$details->token}}' > Verify </a> To verify. </p>

	<div style="text-align: center; font-size: 12px;">
		{{ 'OliveC@contact_us' }}
	</div>
</div>