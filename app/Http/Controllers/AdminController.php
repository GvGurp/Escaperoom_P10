<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin/admin_home'); // Zorg ervoor dat je de juiste Blade-view hebt
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin_edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'admin_code' => 'required',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->admin_code, $admin->admin_code)) {
            return back()->withErrors(['admin_code' => 'Ongeldige admincode.']);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return back()->with('success', 'Accountgegevens succesvol bijgewerkt.');
    }
}
