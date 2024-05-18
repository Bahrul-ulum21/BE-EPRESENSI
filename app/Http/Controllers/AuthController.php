<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Nik / Password Salah']);
        }


    }

    public function proseslogout()
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate using the 'user' guard
        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();

            // Check if the authenticated user has the admin role
            if ($user->hasRole('admin')) {
                return redirect('/panel/dashboardadmin');
            } elseif ($user->hasRole('employee')) {
                return redirect('/dashboard');
            }
        }

        // Attempt to authenticate using the 'karyawan' guard
        if (Auth::guard('karyawan')->attempt($credentials)) {
            $user = Auth::guard('karyawan')->user();

            // Check if the authenticated user has the admin role
            if ($user->hasRole('admin')) {
                return redirect('/panel/dashboardadmin');
            } elseif ($user->hasRole('employee')) {
                return redirect('/dashboard');
            }
        }

        // Authentication failed
        return redirect('/')->with(['warning' => 'Nik (Username) / Password Salah']);
    }
}
