<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{
    /**
     * Redirect path after login.
     *
     * @var string
     */
    protected $redirectTo = '/products';

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // すでにログインしている場合、ホームページにリダイレクト
        if (Auth::check()) {
        return redirect('/home'); // ホームページやダッシュボードに変更
        }

        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // ログイン処理
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // remember トークンがある場合のみ true にする

        if (Auth::attempt($credentials, $remember)) {
            logger('Login successful for user: ' . $request->email);
            return redirect()->intended('/products');
        }

        logger('Login failed for user: ' . $request->email);
        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
