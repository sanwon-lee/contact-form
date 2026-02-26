<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $validator = Validator::make($request->all(), [
                User::COL_EMAIL    => ['required', 'email',],
                User::COL_PASSWORD => ['required',],
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::where(User::COL_EMAIL, $request->input(User::COL_EMAIL))->first();

            if ($user && Hash::check($request->input(User::COL_PASSWORD), $user->password)) {
                return $user;
            }

            throw ValidationException::withMessages([
                User::COL_PASSWORD => [trans('auth.failed')],
            ]);
        });
    }
}
