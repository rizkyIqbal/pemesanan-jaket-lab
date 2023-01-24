<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        try {
            Validator::make($input, [
                'password' => $this->passwordRules(),
            ])->validate();
        } catch (ValidationException $e) {
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
