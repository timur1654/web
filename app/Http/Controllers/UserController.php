<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('users.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        session(['user_id' => $user->id]);

        return redirect()->route('home');
    }

    public function loginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $user = User::where('login', $request->login)->first();
        if (!$user || Hash::check($request->password, $user->password)){
            return back()->withErrors(['login' => 'Неверный логин или пароль']);
        }
        session(['user_id' => $user->id]);
        return redirect()->route('about');
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect()->route('about');
    }
}
