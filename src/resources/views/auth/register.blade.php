@extends("auth.auth")

@use("App\Models\User")

@section("title", "Registration")

@section("header_action")
    <a href="{{ route("login") }}" class="header-btn">login</a>
@endsection

@section("content_title", "Register")

@section("auth_form")
    <x-auth-form :action="route('register')" label="登録">
        <x-auth-input-field
            :field="User::COL_NAME"
            type="text"
            value="{{ old('name') }}"
            placeholder="例: 山田　太郎"
        />
        <x-auth-input-field
            :field="User::COL_EMAIL"
            type="email"
            value="{{ old('email') }}"
            placeholder="例: test@example.com"
        />
        <x-auth-input-field
            :field="User::COL_PASSWORD"
            type="password"
            placeholder="例: coachtech1106"
        />
    </x-auth-form>
@endsection
