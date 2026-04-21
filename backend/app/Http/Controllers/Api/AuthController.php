<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * Handle user registration.
     *
     */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ]
        ]);



        $role = User::count() === 0 ? 'admin' : 'user';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
        ], 201);

    }

    /**
     * Handle user login.
     *
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        
        if(!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login exitoso',
            'user' => Auth::user(),
        ]);

    }

    /**
     * Handle user logout.
     *
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout exitoso']);
    }
}
