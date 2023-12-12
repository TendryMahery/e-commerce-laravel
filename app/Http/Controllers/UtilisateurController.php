<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function login(Request $request)
    {
        $user = Utilisateur::where(['email' => $request->email])->first();
        if(!$user|| !Hash::check($request->password,$user->password)){
            return "il y a une erreur ";
        }
        else{
            $request->session()->put('user',$user);
            return redirect("/");
        }
    }

    public function register(Request $request)
    {
       $user = new Utilisateur;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password) ;
        $user->save();

        return redirect('login');
    }
}
