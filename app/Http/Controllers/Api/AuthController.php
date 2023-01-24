<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request, AuthService $authService)
    {
        $token = $authService->createToken($request->email, $request->password);

        if ($token == null) {
            return response()->json("Unauthorized", 401);
        }

        return response()->json(["token" => $token, "token_type" => "Bearer"], 200);

    }

}
