@extends("layouts.app", ["header_class" => "", "main_class" => "bg-stone-200"])

@section("content")
    @yield("content_title")

    <div
        class="mx-auto flex w-3/5 max-w-[700px] items-center justify-center rounded-sm border border-stone-500 bg-white p-12"
    >
        <div class="w-2/3">@yield("auth_form")</div>
    </div>
@endsection
