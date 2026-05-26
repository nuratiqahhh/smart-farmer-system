<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // remove old intended URL
        session()->forget('url.intended');

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | ROLE BASED LOGIN REDIRECT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect('/admin/dashboard');

        } elseif ($user->role === 'farmer') {

            return redirect('/farmer/dashboard');

        } else {

            // buyer
            return redirect('/shop');

        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}