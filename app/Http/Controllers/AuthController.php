<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $yearMonth = now()->format('Y-m');
            return redirect()->intended('/agenda/' . $yearMonth);
        }
        

        return redirect()->back()->withInput()->withErrors(['email' => 'Onjuiste gegevens.']);
    }
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
