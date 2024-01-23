<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Command;

use Illuminate\Http\Request;

class homeController extends Controller
{
    // pour afficher tous categories et produits 
    public function index(){
        $categories=Categorie::all();
        $produits = Produit::with('categorie')->get();
        return view('home', ['produits' => $produits,'categories'=>$categories]);
     }

public function ajouter(Request $request)
{
    $produit = Produit::find($request->id);
    //declarer la session
    $panier = session()->get('panier', []);
    //ajouter des produit dans la session
    // Si le produit existe déjà dans le panier, augmentez la quantité
    if (isset($panier[$request->id])) {
        $panier[$request->id]['quantite']++;
    } else {
        // Sinon, ajoutez le produit au panier avec la quantité 1
        $panier[$request->id] = [
            "name" => $produit->name,
            "quantite" => 1,
            "prix-unitaire" => $produit->prix,
            "image" => $produit->image_path
        ];
    }
    session()->put('panier', $panier,);
    return response()->json(['message' => 'le produit a ete bien ajouter']);

 
}

// ajouter 1 pour la quantite  a la liste
public function augmenter($id)
{
    $panier = session()->get('panier');
    if (isset($panier[$id])) {
        $produit=Produit::find($id);
        $stock=$produit->stock;
        if( $panier[$id]['quantite']<$stock){
        $panier[$id]['quantite'] = $panier[$id]['quantite'] + 1;
    }
}
    session()->put('panier', $panier,);
    return response()->json(['message' => 'on a augmenter la quantite de produit']);

}
public function listpanier()
{
    $panier = session()->get('panier');
    return view('panier', compact('panier'));
}
// deminuer la quantite
public function deminuer($id)
{
    $panier = session()->get('panier');
    if (isset($panier[$id])) {
        if ($panier[$id]['quantite'] > 1) {
            $panier[$id]['quantite'] = $panier[$id]['quantite'] - 1;
        } else { // si elle est 1 
            unset($panier[$id]);
        }
    }
    session()->put('panier', $panier,);
    return response()->json(['message' => 'la quantite de produits a ete dimunuer']);

}

// pour supprimer
public function destroy($id)
{
    $panier = session()->get('panier');
    if (isset($panier[$id])) {
        unset($panier[$id]);
    }
    session()->put('panier', $panier,);
    return response()->json(['message' => 'le produit a ete supprimer dans le panier ']);

}


}