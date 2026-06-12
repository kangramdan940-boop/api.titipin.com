<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect('/admin/dashboard');
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(['identifier' => 'required', 'pin' => 'required|size:6']);

        $user = User::where('phone', $request->identifier)
            ->orWhere('email', $request->identifier)
            ->first();

        if (!$user || !Hash::check($request->pin, $user->password)) {
            return back()->withErrors(['identifier' => 'Email/HP atau PIN salah'])->withInput();
        }

        Auth::login($user);
        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
