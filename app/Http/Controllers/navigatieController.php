<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;

class navigatieController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        if (auth()->user()->admincode === '222222') {
            return redirect()->route('admin');
        }
        return view('dashboard'); // Voor normale gebruikers
    }

    public function admin()
    {
        return view('admin'); // Admin-specifieke pagina
    }

    public function login()
    {
        return view('auth.login'); // Toon login/registratiepagina
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
