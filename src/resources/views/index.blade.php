@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header__btn">Logout</button>
</form>
@endsection

@section('content')
<h2>Contact</h2>

@endsection