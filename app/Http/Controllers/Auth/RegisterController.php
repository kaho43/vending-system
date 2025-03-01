<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // ユーザー登録（nameフィールドは不要）
        User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // ログイン後、ダッシュボードにリダイレクト
        return redirect()->route('login');
    }
}
