@extends("layouts.app")

@section("title", "Create")

@section("content")
    <x-content-title>Contact</x-content-title>

    <form
        action="{{ route("contacts.confirm") }}"
        method="POST"
        class="mx-auto grid w-[80%] max-w-[1230px] grid-cols-2 items-center gap-6 text-stone-500"
        novalidate
    >
        @csrf
        <label>
            {{ __("validation.attributes.full_name") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative flex justify-between gap-4">
            <input
                type="text"
                name="last_name"
                value="{{ old("last_name", session("contact_data.last_name")) }}"
                placeholder="例: 山田"
                class="contact-field grow"
            />
            @error("last_name")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror

            <input
                type="text"
                name="first_name"
                value="{{ old("first_name", session("contact_data.first_name")) }}"
                placeholder="例: 太郎"
                class="contact-field grow"
            />
            @error("first_name")
                <span class="absolute top-full right-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="gender">
            {{ __("validation.attributes.gender") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative flex">
            @foreach ($genders as $value => $name)
                <input
                    type="radio"
                    name="gender"
                    value="{{ $value }}"
                    class="contact-field"
                    @checked(old("gender", session("contact_data.gender")) == $value)
                />
                <label for="{{ $value }}" class="me-16">
                    {{ $name }}
                </label>
            @endforeach

            @error("gender")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="email">
            {{ __("validation.attributes.email") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative">
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old("email", session("contact_data.email")) }}"
                placeholder="例: test@example.com"
                class="contact-field"
            />
            @error("email")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label>
            {{ __("validation.attributes.tel") }}
            <span class="align-middle text-red-400">※</span>
        </label>
        <div class="relative flex items-center justify-between">
            <input
                type="tel"
                name="tel_1"
                value="{{ old("tel_1", session("contact_data.tel_1")) }}"
                placeholder="090"
                class="contact-field shrink"
            />
            <label>-</label>
            <input
                type="tel"
                name="tel_2"
                value="{{ old("tel_2", session("contact_data.tel_2")) }}"
                placeholder="1234"
                class="contact-field shrink"
            />
            <label>-</label>
            <input
                type="tel"
                name="tel_3"
                value="{{ old("tel_3", session("contact_data.tel_3")) }}"
                placeholder="5678"
                class="contact-field shrink"
            />
            @error("tel")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="address">
            {{ __("validation.attributes.address") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative">
            <input
                type="text"
                id="address"
                name="address"
                value="{{ old("address", session("contact_data.address")) }}"
                placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                class="contact-field w-full"
            />
            @error("address")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="building">
            {{ __("validation.attributes.building") }}
        </label>
        <div class="relative">
            <input
                type="text"
                id="building"
                name="building"
                placeholder="千駄ヶ谷マンション101"
                value="{{ old("building", session("contact_data.building")) }}"
                class="contact-field w-full"
            />
            @error("building")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="category_id">
            {{ __("validation.attributes.category_id") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative">
            <select name="category_id" class="contact-field">
                <option
                    disabled
                    value=""
                    @selected(old("category_id", session("contact_data.category_id")) === null)
                >
                    選択してください
                </option>
                @foreach ($categories as $id => $content)
                    <option
                        value="{{ $id }}"
                        @selected(old("category_id", session("contact_data.category_id")) == $id)
                    >
                        {{ $content }}
                    </option>
                @endforeach
            </select>
            @error("category_id")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <label for="detail" class="self-start">
            {{ __("validation.attributes.detail") }}
            <span class="text-red-400">※</span>
        </label>
        <div class="relative">
            <textarea
                name="detail"
                id="detail"
                placeholder="お問い合わせ内容をご記載ください"
                rows="7"
                class="contact-field w-full"
            >
{{ old("detail", session("contact_data.detail")) }}</textarea
            >
            @error("detail")
                <span class="absolute top-full left-0 text-red-500">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button
            class="col-span-2 mx-auto cursor-pointer bg-stone-500 px-6 py-2 text-white"
        >
            確認画面へ
        </button>
    </form>
@endsection
