<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login() {
        $user = User::where('email', request('email'))->first();
        $hash =  Hash::check(request('password'), $user->password);

        if ($user && $hash) {
            $token = $user->createToken('login');

            return [
                'token' => $token->plainTextToken,
            ];
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}