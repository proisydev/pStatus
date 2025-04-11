@extends('layouts.app')

@section('title', 'API Error')

@section('content')
    <h1>An error occurred while fetching API data:</h1>
    <p>{{ $error }}</p>
@endsection
