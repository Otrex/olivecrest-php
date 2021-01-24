@extends('layout')

@section('title', $title ?? 'Welcome' )

@section('body')
    <div class="page-not-found">
        <h1> 404 </h1>
        <h2> Page: <b>{{$message}}</b> not found </h2>
    </div>
@endsection

