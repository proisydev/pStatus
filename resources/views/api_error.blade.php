@extends('layouts.app')

@section('title', 'All monitors')

@section('content')
    <h1>An error occurred while fetching weather data:</h1>
    <p>{{ $error }}</p>
@endsection
