<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect('dashboard');
        } else {
            return  redirect('/')->withErrors('Username dan Password tidak sesuai')->withInput();
        }
    }


    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
