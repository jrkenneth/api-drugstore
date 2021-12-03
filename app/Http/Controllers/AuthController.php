<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'location' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'phone_number' => $request->phone_number
        ]);

        $user->save();
        return response()->json(['message' => 'User has been registered'], 200);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorised'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        $token->expires_in = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json(['data' => [
            'user' => Auth::user(),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_in)->toDateTimeString()
        ]]);
    }
}
