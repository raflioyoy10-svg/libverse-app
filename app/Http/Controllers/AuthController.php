<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================
    // LOGIN PAGE
    // ===============================
    public function loginPage()
    {
        return view('auth.login');
    }

    // ===============================
    // PROSES LOGIN
    // ===============================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ada atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah!');
        }

        // Login
        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/member');
    }

    // ===============================
    // REGISTER PAGE
    // ===============================
    public function registerPage()
    {
        return view('auth.register');
    }

    // ===============================
    // PROSES REGISTER
    // ===============================
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'member', // auto member
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // ===============================
    // LOGOUT
    // ===============================
    public function logout()
    {
        Auth::logout();
    return redirect()->route('public.member');
    }
}
