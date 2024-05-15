<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /**
             * @var User
             */
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return redirect()->route('dash.dashboard')->with('token', $token);
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        /**
         * @var User
         */
        $user = Auth::user();
        // Revoke all tokens issued to the user
        $user->tokens->each->delete();

        // Clear all session data
        $request->session()->flush();

        return redirect()->route('login');
    }
}
