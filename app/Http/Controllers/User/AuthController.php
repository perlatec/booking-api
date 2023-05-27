<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * login
     *
     * @param  mixed $request
     * @return UserResponse
     */
    public function login(Request $request): UserResponse
    {
        $validator = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string',],
        ]);

        if (auth()->attempt($validator)) {
            $user = auth()->user();
            $token = $request->user()->createToken('token_name');
            return (new UserResponse($user))
                ->additional(['auth_token' => $token->plainTextToken]);
        } else abort(Response::HTTP_UNAUTHORIZED);
    }
}
