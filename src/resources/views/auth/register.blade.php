@extends("auth.auth")

@use("App\Models\User")

@section("title", "Registration")

@section("header_action")
    <a href="{{ route("login") }}" class="header-btn">login</a>
@endsection

@section("contnt_title")
    <x-content-title>Register</x-content-title>
@endsection

@section("auth_form")
    <x-auth-form :action="route('register')" label="登録">
        <x-auth-input-field
            field="name"
            type="text"
            value="{{ old('name') }}"
            placeholder="例: 山田　太郎"
        />
        <x-auth-input-field
            field="email"
            type="email"
            value="{{ old('email') }}"
            placeholder="例: test@example.com"
        />
        <x-auth-input-field
            field="password"
            type="password"
            placeholder="例: coachtech1106"
        />
    </x-auth-form>
@endsection
