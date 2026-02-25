@extends('layouts.app')

@section('title', 'Admin')

@section('header_action')
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button  class="header-btn">logout</button>
    </form>
@endsection