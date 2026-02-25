@extends('layouts.app', [
    'header_class' => '',
    'main_class' => 'bg-stone-200',
])

@section('content')
    <h2 class="text-stone-500 font-faustina font-semibold text-2xl mx-auto w-fit pbe-12">@yield('content_title')</h2>

    <div class="flex justify-center items-center border rounded-sm border-stone-500 bg-white mx-auto p-12 w-3/5 max-w-[700px]">
        <div class="w-2/3">
            @yield('auth_form')
        </div>
    </div>
@endsection