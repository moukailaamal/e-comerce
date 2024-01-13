<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProduitsController extends Controller
{
    public function __invoke()
    {
        // Logique du contrôleur ici
    }

    // Afficher tous les produits
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', ['produits' => $produits]);
    }

    // Seuls les administrateurs peuvent créer d'autres produits
    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            $produit = new Produit();
            $produit->name = $request->input('name');
            $produit->prix = $request->input('prix');
            $produit->categorie_id = $request->input('categorie_id');
            $produit->stock = $request->input('stock');
            $produit->description = $request->input('description');

            $path = $request->file('image')->store('public/produits');
            $produit->image_path = Storage::url($path);

            $produit->save();
            
            return redirect()->route('produits.index')->with('success', 'Félicitations ! Le produit a été créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('produits.create')->with('error', 'Erreur ! Le produit n\'a pas pu être créé.');
        }
    }

    public function edit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produits.update', ['produit' => $produit, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::find($id);
        $produit->name = $request->input('name');
        $produit->prix = $request->input('prix');
        $produit->stock = $request->input('stock');
        $produit->description = $request->input('description');

        if ($request->hasFile('image')) {
            Storage::delete($produit->image_path);
            $path = $request->file('image')->store('public/produits');
            $produit->image_path = Storage::url($path);
        }

        $produit->save(); // Appel de la méthode save() pour effectuer la mise à jour

        if ($produit->wasChanged()) {
            return redirect()->route('produits.index')->with('success', 'Félicitations ! Vous avez modifié votre produit.');
        } else {
            return redirect()->route('produits.index')->with('error', 'Aucune modification apportée au produit.');
        }
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);
        if ($produit) {
            $produit->delete();
            return redirect()->route('produits.index')->with('success', 'Félicitations ! Le produit a été supprimé avec succès.');
        } else {
            return redirect()->route('produits.index')->with('error', 'Erreur ! Le produit n\'a pas pu être trouvé ou supprimé.');
        }
    }

    public function quantiteDeStock($id)
    {
        $produit = Produit::find($id);
        if ($produit) {
            $quantite = $produit->stock;
            return $quantite;
        } else {
            return redirect()->route('produits.index')->with('error', 'Produit introuvable');
        }
    }

    // Rechercher un produit à travers son nom
    public function rechercherProduit($name)
    {
        $produit = Produit::where('name', $name)->first();
        if ($produit) {
            return view('produits.indexProduit', ['produit' => $produit]);
        } else {
            // Retourner à l'index avec un message d'erreur
            return redirect()->route('produits.index')->with('error', 'Produit introuvable');
        }
    }

    // afficher la liste de produit à travers l'id de catégorie
    public function listeProduit($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        $categorie = Categorie::where('id', $id)->first();
        $nomCategorie = $categorie->name;
        return view('produits.listeProduit', ['produits' => $produits, 'nomCategorie' => $nomCategorie]);
    }

    // afficher les détails d'un produit
    public function indexProduit($id)
    {
        $produit = Produit::find($id);
        if ($produit) {
            return view('afficheProduit', ['produit' => $produit]);
        }
    }
}
