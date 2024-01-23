<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Produit;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commandsController extends Controller
{

    public function message(){

        return response()->json(['Qmzal' => 'Alouoi réussie']);
    }
    // afficher tous les commands
    public function index($id)
    {
        if (auth()->check() && auth()->user()->id == $id && auth()->user()->role == 'client') {
            $commands = Command::where('user_id', $id)->get();
            return view('commands.index', ['commands' => $commands]);
        } elseif (auth()->check() && auth()->user()->role == 'admin') {
            $commands = Command::all();
            return view('commands.index', ['commands' => $commands]);
        } else {
            return redirect()->route('home');
        }
    }

    public function contenu($id)
    {
        $command = Command::find($id);
        $contenu = json_decode($command->contenu);
        return view('commands.contenu', ['contenu' => $contenu]);
    }
    public function updateStatus($id)
    {
        $command = Command::find($id);
        if ($command->statut == true) {
            $command->statut = false;
        } else {
            $command->statut = true;
        }
        $command->save();
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }

    public function passerCommande(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'adresse' => 'required|string', // Assure que 'adresse' est présent et est une chaîne de caractères
        ]);
    
        // Récupération du panier depuis la session
        $panier = session()->get('panier');
    
        // Création d'une nouvelle commande
        $commande = new Command();
        $commande->user_id = Auth::id();
        $commande->contenu = json_encode($panier);
        $commande->statut = false;
        $commande->adresse = $request->input('adresse');
        $commande->save();
      
        foreach ($panier as $id=>$content) {

            $produit = Produit::find($id);
            
            // Assurez-vous que le produit existe avant de manipuler le stock
            if ($produit) {
                $produit->stock =$produit->stock -$content['quantite'];
                $produit->save(); 
            }
        }
        // pour supprimer le panier
        session()->forget('panier');
    
        
    
        return redirect()->route('home')->with('success', 'Commande passée avec succès!');
    }
    
    
        }
    
