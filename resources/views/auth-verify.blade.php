@extends('layout')

@section('title', $title ?? 'Welcome' )

@section('body')
    <div id='message'>
        <h1> {{$message}} </h1>
    </div>
@endsection

