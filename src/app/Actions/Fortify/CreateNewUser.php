<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            User::COL_NAME => ['required',],
            User::COL_EMAIL => [
                'required',
                'email',
            ],
            User::COL_PASSWORD => $this->passwordRules(),
        ])->validate();

        return User::create([
            User::COL_NAME => $input[User::COL_NAME],
            User::COL_EMAIL => $input[User::COL_EMAIL],
            User::COL_PASSWORD => Hash::make($input[User::COL_PASSWORD]),
        ]);
    }
}
