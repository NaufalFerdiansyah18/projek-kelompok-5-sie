<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'Super Admin',
        ]);

        return redirect()->route('auth')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

             Auth::login($user);
            session(['last_login' => now()]);

            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }

    function logout(Request $request)
{
		Auth::logout();
    $request->session()->invalidate();     // Hapus semua session
    $request->session()->regenerateToken(); // Cegah CSRF

		// Redirect ke halaman login
        return redirect()->route('auth');
}
}
