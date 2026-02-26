@extends("auth.auth")

@use("App\Models\User")

@section("title", "Login")

@section("header_action")
    <a href="{{ route("register") }}" class="header-btn">register</a>
@endsection

@section("content_title", "login")

@section("auth_form")
    <x-auth-form :action="route('login')" label="ログイン">
        <x-auth-input-field
            :field="User::COL_EMAIL"
            type="email"
            placeholder="例: test@example.com"
        />
        <x-auth-input-field
            :field="User::COL_PASSWORD"
            type="password"
            placeholder="例: coachtech1106"
        />
    </x-auth-form>
@endsection
