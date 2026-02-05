<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// --- CORRECCIÓN AQUÍ ---
// Usamos la ruta real de tu aplicación, no la del disco duro ni la de vendor
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

        // --- TU LÓGICA DE ADMIN (ESTÁ PERFECTA) ---
        if (Auth::user()->role_id == 2) {
            // Asegúrate de que esta ruta 'admin.home' exista en web.php
            return redirect()->route('admin.home');
        }

        return redirect()->intended('/');
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
