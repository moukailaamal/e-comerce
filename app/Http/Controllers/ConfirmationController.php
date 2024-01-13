<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function verify($token)
    {
       
        $user = User::where('confirmation_token', $token)->first();
        // Ajoutez cette ligne pour afficher les valeurs
    
        if (!$user) {
            return redirect()->route('auth.loginform')->with(['error' => 'Token de confirmation invalide.']);
        }
    
        // Mettez à jour le statut de confirmation de l'utilisateur
        $user->confirmation_token = null;
        $user->email_verified_at = now(); // ou utilisez le format de date approprié
        $user->save();

        return redirect()->route('auth.loginform')->with(['success' => 'Votre adresse e-mail a été confirmée avec succès. Vous pouvez maintenant vous connecter.']);
    }
}
