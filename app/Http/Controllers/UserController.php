<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
//            session()->flash('success', 'Вы авторизоованны');
            if(Auth::user()->is_admin) {
                return redirect()->route('orders.index');
            }
        }
        return redirect()->back()->with('error', 'Некорректные логин и пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

}
