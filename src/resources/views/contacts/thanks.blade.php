@extends("layouts.app", ["main_class" => "relative flex items-center justify-center"])

@section("title", "Thanks")

@section("content")
    <div
        aria-hidden="true"
        class="font-faustina absolute inset-0 flex items-center justify-center text-[12rem] font-semibold text-stone-50 opacity-50 select-none"
    >
        Thank you
    </div>

    <div class="z-10 text-center">
        <h2 class="mbe-6 text-xl font-medium text-stone-700">
            お問い合わせありがとうございました
        </h2>
        <a
            href="{{ route("contacts.create") }}"
            class="inline-block bg-[#8b7969] px-8 py-2 text-sm text-white transition hover:opacity-80"
        >
            HOME
        </a>
    </div>
@endsection
