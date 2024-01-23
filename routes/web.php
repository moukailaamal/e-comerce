<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\produitsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\commandsController;
use App\Http\Controllers\ConfirmationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// register et login et logout 

Route::get('/register',[userController::class,'registerForm'])->name('auth.registerForm');
Route::post('/register',[userController::class,'register'])->name('auth.register');
Route::get('/login',[userController::class,'loginForm'])->name('auth.loginform');
Route::post('/login',[userController::class,'login'])->name('auth.login');
Route::post('/logout',[userController::class,'logout'])->name('auth.logout');
Route::get('/edit/{id}',[userController::class,'edit'])->name('auth.edit');
Route::post('/update/{id}',[userController::class,'update'])->name('auth.update');


Route::middleware(['admin'])->group(function () {
Route::resource('categories',categoriesController::class)->names([
    'index' =>'categories.index',
    'create'=>'categories.create',
    'store'=>'categories.store',
    'edit'=>'categories.edit',
    'update'=>'categories.update',
    'destroy'=>'categories.destroy',
    'listCategories'=>'categories.listCategories'
]);
// Les produits 
Route::resource('produits', ProduitsController::class)->names([
    'index' => 'produits.index',
    'create' => 'produits.create',
    'store' => 'produits.store',
    'edit' => 'produits.edit',
    'update' => 'produits.update',
    'destroy' => 'produits.destroy',
    
]);

});
// Ajoutez la route personnalisée pour listeProduit
Route::get('produits/listeProduit/{id}', [produitsController::class, 'listeProduit'])->name('produits.listeProduit');

// acceuil
Route::get('/',[homeController::class,'index'])->name('home');
Route::get('/afficheProduit/{id}', [ProduitsController::class, 'indexProduit'])->name('afficheProduit');
// le panier 
Route::middleware(['email.confirmation'])->group(function () {

Route::get('/panier/augmenter/{id}',[homeController::class,'augmenter'])->name('panier.augmenter');
Route::post('/panier/ajouter',[homeController::class,'ajouter'])->name('panier.ajouter');
Route::post('panier/deminuer/{id}', [HomeController::class, 'deminuer'])->name('panier.deminuer');
Route::post('panier/destroy/{id}', [HomeController::class, 'destroy'])->name('panier.destroy');
Route::post('panier/deminuerProduit/{idCommande}', [HomeController::class, 'deminuerProduit'])->name('panier.deminuerProduit');

// command
Route::get('command/index/{id}', [commandsController::class, 'index'])->name('command.index');
Route::get('command/contenu/{id}', [commandsController::class, 'contenu'])->name('command.contenu');
Route::post('command/updateStatus/{id}', [commandsController::class, 'updateStatus'])->name('command.updateStatus');
Route::post('command/passerCommande', [commandsController::class, 'passerCommande'])->name('command.passerCommande');
});

Route::get('/confirmation/{token}', [ConfirmationController::class,'verify'])->name('confirmation.verify');

Route::get('/message', [commandsController::class, 'message']);
