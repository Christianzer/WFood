<?php

use App\Http\Controllers\FoodControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Endpoints pour la recupération du menu journalier
Route::get('listes-des-plats', [FoodControllers::class, 'ListesDesPlats']);

// Endpoints pour la liste des commandes
Route::get('listes-des-commandes/{id}/{dateDebut}/{dateFin}', [FoodControllers::class, 'ListesCommandes']);

// Endpoint de connexion
Route::post('connexion', [FoodControllers::class, 'login']);

//Endpoint de creation de compte
Route::post('creation', [FoodControllers::class, 'store']);


//Recuperer les produits du panier
Route::post('panier',[FoodControllers::class, 'panier']);

//Inserer la commande
Route::post('commandes', [FoodControllers::class, 'storeCommande']);
