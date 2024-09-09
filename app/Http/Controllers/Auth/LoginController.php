<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect the user based on their role after login
    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 0) {
            Auth::logout(); 
            return redirect('/login')->withErrors(['email' => 'Your account is inactive. Please contact support.']);
        }

        if ($user->type === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('dashboard');
    }

    // Modify credentials check
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = 1; // Ensure the user is active

        return $credentials;
    }
}
