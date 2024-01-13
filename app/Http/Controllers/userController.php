<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationMail;
class userController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }
    protected function register( Request  $request)
        {
        

   
        $auth=new User();
        $auth->name=$request->input('name');
        $auth->prenom=$request->input('prenom');
        $auth->numero=$request->input('numero');
        $auth->adresse=$request->input('adresse');
        $auth->role='client';
        $auth->genre=$request->input('genre');
        $auth->date_naissance=$request->input('date_naissance');
        $auth->profession=$request->input('profession');
        $auth->email=$request->input('email');
        $auth->password=Hash::make($request->input('password'));
        $auth->adresse=$request->input('adresse');

         $confirmation_token = Str::uuid();
        $auth->confirmation_token = $confirmation_token;
        $auth->save();
        // Enregistrement réussi
        $confirmationLink = route('confirmation.verify', ['token' => $confirmation_token]);

        Mail::to($auth->email)->send(new ConfirmationMail($auth, $confirmationLink));

        return redirect()->route('auth.loginform')->with(['success' => 'Inscription réussie!']);
 
    }
    public function loginForm(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // L'utilisateur est authentifié
            return redirect("/")
                ->with('success', 'Bienvenue! Vous êtes connecté.')
               ; // Expire après 5 secondes
        }
    
        // Si l'authentification échoue, redirigez vers le formulaire de connexion avec un message d'erreur
        return redirect()->route('auth.login')
            ->with('error', 'Adresse e-mail ou mot de passe incorrect.')
           ; 
    }
    
    public function logout()
    {
        Auth::logout();
       return redirect("/");
    }
    // pour modifier les information 
    public function edit($id)
    {
        if (auth()->check() && auth()->user()->id==$id&& auth()->user()->role=='client'){

        $user = User::find($id);
    return view('auth.update', ['user' => $user]);
         } else{
        return redirect()->route('home') ;
    }
}


public function update(Request $request, $id)
{
    if (auth()->check() && auth()->user()->id == $id && auth()->user()->role == 'client') {
        $auth = User::find($id);

        // Assurez-vous que l'utilisateur existe avant de tenter de le mettre à jour
        if (!$auth) {
            return redirect()->route('home')->with('error', 'Utilisateur non trouvé.');
        }

        // Récupérez les valeurs actuelles avant la mise à jour
        $oldValues = $auth->getAttributes();

        // Mettez à jour les propriétés de l'utilisateur
        $auth->name = $request->input('name');
        $auth->prenom = $request->input('prenom');
        $auth->numero = $request->input('numero');
        $auth->adresse = $request->input('adresse');
        $auth->role = 'client';
        $auth->genre = $request->input('genre');
        $auth->date_naissance = $request->input('date_naissance');
        $auth->profession = $request->input('profession');
        $auth->email = $request->input('email');

        // Vérifiez si un nouveau mot de passe est fourni et le hachez
        $password = $request->input('password');
        if ($password) {
            $auth->password = Hash::make($password);
        }

        // Sauvegardez les modifications
        $auth->save();

        // Récupérez les nouvelles valeurs après la mise à jour
        $newValues = $auth->getAttributes();

        // Comparez les valeurs avant et après la mise à jour
        if ($auth->wasChanged()) {
            return redirect()->route('home')->with('success', 'Profil mis à jour avec succès.')
           ;
        } else {
            return redirect()->route('home')->with('error', 'Aucune modification apportée au profil.');
        }
    } else {
        return redirect()->route('home')->with('error', 'Vous n\'avez pas l\'autorisation de mettre à jour ce profil.');
    }
}

}
