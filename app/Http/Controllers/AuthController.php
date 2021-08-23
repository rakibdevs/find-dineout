<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }


    public function register(Request $request)
    {
        $input = [
            'name' => 'Admin',
            'email' => 'info@foodmoy.com',
            'password' => '@foodie',
            'user_type' => 'admin'
        ];
        $user = User::create($input);

        /*return [
            'status' => false,
            'error' => 'The provided credentials do not match our records.',
        ];*/
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();

            return [
                'status' => true,
                'user' => auth()->user()
            ];
        }

        return [
            'status' => false,
            'error' => 'The provided credentials do not match our records.',
        ];
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
