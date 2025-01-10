@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
<a href="/login" class="login-btn">login</a>
@endsection

@section('content')
<div class="register">
    <h1>Register</h1>
</div>

@endsection