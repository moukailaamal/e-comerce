<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie; 
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class categoriesController extends Controller
{
    public function index(){
        $categories=Categorie::all();
        return view('categories.index',['categories'=>$categories]);
    }
    // les seules qui peuvent cree des autres categories sont l'adminstation
    public function create(){
        return view('categories.create');
    }
    public function store(Request $request)
    {
        try {
            $categorie = new Categorie();
            $categorie->name = $request->input('name');
            $categorie->save();
    
            return redirect()->route('categories.index')
                ->with('success', 'Félicitations ! La catégorie a été créée avec succès.')
               ;
        } catch (\Exception $e) {
            // En cas d'erreur lors de la création de la catégorie
            return redirect()->route('categories.create')
                ->with('error', 'Erreur ! La catégorie n\'a pas pu être créée.')
               ;
        }
    }
    public function edit($id){
        $categorie = Categorie::find($id);
        return view('categories.update', ['categorie' => $categorie]);
    }

  

    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->name = $request->input('name');
        $categorie->save(); // Utilisez "save" au lieu de "update" pour déclencher correctement les événements de modèle
    
        if ($categorie->wasChanged()) {
            // La catégorie a été modifiée avec succès
            return redirect()->route('categories.index')
                ->with('success', 'Félicitations ! Vous avez modifié votre catégorie.')
               ;
        } else {
            // Aucune modification n'a été apportée à la catégorie
            return redirect()->route('categories.index')
                ->with('error', 'Aucune modification apportée à la catégorie.')
               ;
        }
    }
    
   public function destroy($id)
{
    $categorie = Categorie::find($id);

    if ($categorie) {
        // Supprimer les produits liés à la catégorie
        Produit::where('categorie_id', $id)->delete();

        // Supprimer la catégorie
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Félicitations ! La catégorie a été supprimée avec succès.')
           ;
    } else {
        // La catégorie n'a pas été trouvée
        return redirect()->route('categories.index')
            ->with('error', 'Erreur ! La catégorie n\'a pas pu être trouvée ou supprimée.')
           ;
    }
}

   
}
