@extends('layout')

@section('title', $title ?? 'Welcome' )

@section('style')
<style >
	a {
		background-color: orange;
		padding: 5px;
	}
	a:hover {
		background-color: black;
		color: orange;
		font-weight: bold;
	}
	#message {
		text-align: center;
	}
	h1 {
		font-size: 2rem;
	}
</style>
@endsection

@section('body')
    <div id='message'>
        <h1> {{$message}} </h1>
        <a href="/#/login"> Sign In </a>
    </div>
@endsection

