<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminController extends Controller
{
    public function showFormLogin()
    {
        return view('admin.Auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful');
        }
    }

    public function dashboard()
    {
        return view('admin.Home.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.show.formLogin')->with('success', 'Logout successful');
    }
}
