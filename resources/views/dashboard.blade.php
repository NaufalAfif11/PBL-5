@extends('layouts.dashboard')

@section('content')
    <h2>Selamat Datang Di VACCINE SCHEDULE, {{ Auth::user()->name }}</h2>
    <img src="{{ asset('images/vaksin-info.png') }}" class="img-fluid mt-4" alt="Informasi Vaksin">
@endsection
