<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function register(RegisterRequest $request):JsonResponse
    {

        $user= User::create($request->validated());


        $token= $user->createToken('api');

        return response()->json([
            'token'=>$token->plainTextToken,
            'user'=>[
                'id'=>$user->id,
                'name' =>$user->name,
                'email'=>$user->email
            ]
        ],201);
    }

    public function login(LoginRequest $request): JsonResponse
    {

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        /** @var User $user */
        $user = Auth::user();

        $token= $user->createToken('api');

        return response()->json([
            'token'=> $token->plainTextToken,
            'user'=>[
                'id'=>$user->id,
                'name' =>$user->name,
                'email'=>$user->email
            ]
        ]);
    }

    public function userInfo(Request $request): JsonResponse
    {
        dd($request);
        /** @var User */
        $user =$request->user();

        return response()->json([
            'name'=>$user->name,
            'email'=>$user->email
        ]);
    }
}
