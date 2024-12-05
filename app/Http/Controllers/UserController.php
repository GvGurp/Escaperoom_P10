<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
   // Toon profielbewerken-pagina (Gaby)
public function edit()
{
    $user = Auth::user();
    return view('player.edit', compact('user')); // Update de view naar de nieuwe locatie
}



    // Update profielinformatie (Gaby)
    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.edit')->with('success', 'Profiel succesvol bijgewerkt.');
    }

    public function profile()
{
    $user = Auth::user();
    return view('profile');
}
}

