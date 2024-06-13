<?php

// app/Http/Controllers/Auth/AuthenticatedSessionController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using email and password
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            Session::flash('success', 'Logged in successfully!');
            return redirect('/forbest');
        } else {
            Session::flash('error', 'Incorrect email or password.');
            return back()->withInput();
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::flash('success', 'Logged out successfully!');
        return redirect('/forbest');
    }
}



