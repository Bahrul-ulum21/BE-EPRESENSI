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
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        // Attempt to authenticate using the 'user' guard
            // Check if the authenticated user has the admin role
            if ($user->hasRole('admin')) {
                return redirect('/panel/dashboardadmin');
            } elseif ($user->hasRole('employee')) {
                return redirect('/dashboard');
            }



        // Authentication failed
        return redirect('/')->with(['warning' => 'Nik (Username) / Password Salah']);
    }
}
