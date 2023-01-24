<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthService
{

    public function createToken($email, $password): string|null
    {
        if (!Auth::attempt(["email" => $email, "password" => $password])) {
            return null;
        }

        $user = User::where("email", $email)->firstOrFail();
        $token_name = Crypt::encryptString($request->device_id . "_" . $user->id);

        return $user->createToken($token_name)->plainTextToken;
    }

}
