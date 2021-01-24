@extends('layout')

@section('title', $title ?? 'Welcome' )

@section('style')
    <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
@endsection


@section('body')
    {{ csrf_field() }}
@endsection


@section('script')
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <script src="/js/main.js"></script>
@endsection