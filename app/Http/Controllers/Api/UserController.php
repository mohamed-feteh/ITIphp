<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }
    public function update(request $request, User $user)
    {
        $request->validate([
            'email' => 'string|email|max:255|unique:users,email',
            'password' => 'string|max:255',
        ]);
        $user->update(['email' => $request-> email,
        'password' => Hash::make($request->password)]);

        return new UserResource($user);
    }
    public function destroy(User $user)
    {
        $user->delete();

        return new UserResource($user);
    }
}

