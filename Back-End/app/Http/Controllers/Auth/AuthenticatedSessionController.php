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

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('guest/home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

    // محاولة مصادقة المستخدم باستخدام البريد الإلكتروني وكلمة المرور 
        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return redirect('/forbest');
        }

        

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/forbest');
    }
}
