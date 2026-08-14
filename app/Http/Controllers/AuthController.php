<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }
        $token = $user->createToken('mobile')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }

   public function logout(Request $request)
{
    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'Not authenticated'], 401);
    }

    $current = $user->currentAccessToken();
    if ($current) {
        $current->delete();
    }

    return response()->json(['message' => 'Logged out']);
}

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
