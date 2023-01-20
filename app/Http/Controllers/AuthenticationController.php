<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::flash('email', $request->email);
        $data = User::all();
        return view('login')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ],[
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Email Harus Berformat Email',
            'password.required' => 'Password Harus Diisi',
            'password.min' => 'Password Minimal 8 Karakter'
        ]);

        $cek = $request->only('email', 'password');
        if (Auth::attempt($cek)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function pageRegister(Request $request)
    {
        return view('register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Email Harus Berformat Email',
            'password.required' => 'Password Harus Diisi',
            'password.min' => 'Password Minimal 8 Karakter'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        User::create($data);
        return redirect('/login')->with('success', 'Register Berhasil');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
