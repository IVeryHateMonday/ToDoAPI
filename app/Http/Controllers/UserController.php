<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function registr(RegisterRequest $request):JsonResponse
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
}
