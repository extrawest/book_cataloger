<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * Login user and create token
     */

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        $credentials = [
            'email' => $request->email,
            'password'  =>  $request->password
        ];

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $createToken = $user->createToken('Author Access Token');

        $token = $createToken->token;
        $token->save();
        $user->remember_token = $createToken->accessToken;
        $user->save();

        return response()->json(['access_token' => $createToken->accessToken]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(
            [
                'message' => 'Successfully logged out'
            ]
        );
    }


}
