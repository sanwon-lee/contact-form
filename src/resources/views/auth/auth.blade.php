@extends("layouts.app", ["header_class" => "", "main_class" => "bg-stone-200"])
@section("content")
    <h2
        class="font-faustina mx-auto w-fit pbe-12 text-2xl font-semibold text-stone-500"
    >
        @yield("content_title")
    </h2>

    <div
        class="mx-auto flex w-3/5 max-w-[700px] items-center justify-center rounded-sm border border-stone-500 bg-white p-12"
    >
        <div class="w-2/3">@yield("auth_form")</div>
    </div>
@endsection
