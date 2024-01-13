<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categorie;

class CategoriesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Partagez la variable $categories avec toutes les vues
        View::composer('*', function ($view) {
            $categories = Categorie::all(); // Ou utilisez votre logique pour récupérer les catégories
            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
