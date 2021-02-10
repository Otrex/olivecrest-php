
<div style='border:2px solid orange; padding: 20px; margin:20px;' >
	<div style="text-align: center;">
		<img style="height: 30px; width: auto;" src="https://362f11b13168.ngrok.io/img/logo6.png">
	</div>
	<div style="text-align: center;">
		<h1> Thank You For Choosing Us </h1>
		<h1> UserId: {{ $details->data['user_id'] }} </h1>
		<h1> Amount: {{ $details->data['amount'] }} </h1>
		<h1> Transaction-Type: {{ $details->data['type'] }} </h1>
		<h2> We hope to give you a spendid experience </h2>

		<p > Go to your admin Panel for more info </p>
		<a href='{{$details->link}}'> Go to Admin </a>
		You can also <b>copy</b> and <b>paste</b> the link: <b>{{$details->link}}</b>
	</div>
	<div style="text-align: center; font-size: 12px;">
		{{ 'OliveC@contact_us' }}
	</div>
</div>