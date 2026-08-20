<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $user = Auth::user();


        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

public function logout(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Not authenticated'], 401);
    }
    $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

    return response()->json(['message' => 'Logged out']);
}




    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
