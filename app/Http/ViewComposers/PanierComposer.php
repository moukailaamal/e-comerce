<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

class PanierComposer
{
    public function compose(View $view)
    {
        $panier = session()->get('panier',[]);
    
        $view->with('panier', $panier);
       
    }
}
