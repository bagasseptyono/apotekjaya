@extends('layouts.main')

@section('main')
    <header>
        @include('layouts.navbar')
    </header>
    <div class="d-flex">
        @if(Auth::check() && Auth::user()->role === 'admin')
            @include('layouts.sidebar')
        @endif
        @yield('admin')
    </div>
@endsection
