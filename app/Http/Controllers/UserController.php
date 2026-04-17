<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 200,
                'message' => 'Login Successful',
                'url' => route('announcements.index') // or your redirect URL
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Login Failed',
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Logout Successful',
            'url'=> route('home')
        ]);
    }
}
