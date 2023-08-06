<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
class LoginController extends Controller
{
    
public function login(Request $request)
{

    $request->validate([
        'email' => 'required|string|email|max:255|exists:users,email',
        'password' => 'required|string|max:255',
    ]);
        if (auth()->attempt([
        'email' => $request->email,
        'password' => $request-> password,
    ])
    ) {
        $user = auth()->user();
        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('token')->plainTextToken;

        return response()->json($data);
    }}

}
