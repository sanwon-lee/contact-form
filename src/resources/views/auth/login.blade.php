@extends("auth.auth")

@use("App\Models\User")

@section("title", "Login")

@section("header_action")
    <a href="{{ route("register") }}" class="header-btn">register</a>
@endsection

@section("content_title")
    <x-content-title>Login</x-content-title>
@endsection

@section("auth_form")
    <x-auth-form :action="route('login')" label="ログイン">
        <x-auth-input-field
            field="email"
            type="email"
            placeholder="例: test@example.com"
        />
        <x-auth-input-field
            field="password"
            type="password"
            placeholder="例: coachtech1106"
        />
    </x-auth-form>
@endsection
