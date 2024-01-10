<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\OfferController;

// User registration route
Route::post('/users/register', [AuthController::class, 'register']);

// User login route
Route::post('/users/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getAllusersNotBan']);


Route::get('/products', [ProduitController::class, 'afficherProduits']);
Route::get('/products/{iduser}', [ProduitController::class, 'afficherProduitsParUtilisateur']);
Route::get('/allproducts/{iduser}', [ProduitController::class, 'afficherNonProduitsParUtilisateur']);
Route::get('/productsCategorie/{user_id}/{categorie_id}', [ProduitController::class, 'afficherProduitsParCategorie']);
Route::post('/userUpdate/{UserId}', [AuthController::class, 'updatePhone']);



// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Get user details
    Route::get('/users/me', [AuthController::class, 'user']);
    // Logout route
    Route::get('/users/logout', [AuthController::class, 'logout']);
});
Route::get('/images/{filename}', [ImageController::class, 'getImage']);

// categorie route
Route::get('/categorie', [CategorieController::class, 'afficherallCategories']);
Route::post('/categories', [CategorieController::class, 'store']);

//produits
Route::post('/ajouter-produit', [ProduitController::class, 'ajouterProduit']);
Route::post('/upload-image/{productId}', [ImageController::class, 'uploadImage']);
Route::post('/update-images/{productId}', [ImageController::class, 'updateImages']);
Route::put('/deleteproduit/{idproduit}', [ProduitController::class, 'deleteProduit']);
Route::put('/productUpdate/{id}', [ProduitController::class, 'updateProduit']);
Route::post('/productReset/{id}', [ProduitController::class, 'ResetProduit']);

Route::delete('/images/{imageId}', [ImageController::class,'deleteImage']);

//Favoris routes
Route::post('/ajouter-favoris/{iduser}/{idproduit}', [FavorisController::class, 'ajouterFavoris']);
Route::get('/favoris/{iduser}', [FavorisController::class, 'getFavorisProducts']);
Route::get('/favoriscount/{iduser}', [FavorisController::class, 'countFavoris']);
Route::delete('/deletefavoris/{idfavoris}', [FavorisController::class, 'deleteFavoris']);

//offre route
Route::post('/ajouter-offre/{iduser}/{idproduit}', [OfferController::class, 'ajouterOffre']);
Route::get('/offers/{productId}', [OfferController::class, 'getOffersForProduct']);
Route::get('/prodoffers/{offreId}', [OfferController::class, 'getProductsForOffer']);
Route::get('/offers-users/{userId}', [OfferController::class, 'getOffersForUser']);
Route::post('/decline-offer/{offerId}', [OfferController::class, 'declineOffer']);
Route::post('/accept-offer/{offerId}', [OfferController::class, 'acceptOffer']);
Route::get('/user-details/{UserId}', [AuthController::class, 'getUserDetails']);







