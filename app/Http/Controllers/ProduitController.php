<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Offre;
use App\Models\Categorie;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;




class ProduitController extends Controller
{
    public function ajouterProduit(Request $request)
{
    // Validation des champs
    $request->validate([
        'nom_produit' => 'required|string|max:255',
        'description' => 'required|string',
        'user_id' => 'required',
        'categorie_id' => 'required|exists:categories,id' // Validate if the category exists
    ]);

    $produit = new Produit();
    $produit->nom_produit = $request->input('nom_produit');
    $produit->description = $request->input('description');
    $produit->user_id = $request->input('user_id');
    $produit->categorie_id = $request->input('categorie_id'); // Set the categorie_id
   
    $produit->save();

    return response()->json(['message' => "produit ajouté avec succés",'idproduit' => $produit->id],201);
}





public function afficherProduits()
{
    $products = Produit::all();

    // Sort products by the most recent date
    $products = $products->sortByDesc('created_at');

    $formattedProducts = [];

    foreach ($products as $product) {
        $formattedImages = ImageProduct::where('produit_id', $product->id)
            ->get()
            ->map(function ($image) {
                return asset('uploads/' . $image->image);
            });

        Carbon::setlocale('fr');

        $formattedProducts[] = [
            'id' => $product->id,
            'nom_produit' => $product->nom_produit,
            'description' => $product->description,
            'images' => $formattedImages,
            'added' => Carbon::parse($product->created_at)->diffForHumans(),
        ];
    }

    return response()->json(['produits' => $formattedProducts]);
}





    public function showProduitForm()
{
    $categories = Categorie::all(); // Fetch all categories from the database
    return view('ajouter_produit', compact('categories'));
}
//mes produits
public function afficherProduitsParUtilisateur($iduser)
{
    $products = Produit::where('user_id', $iduser)->get();

    $formattedProducts = [];

    foreach ($products as $product) {
        $formattedImages = ImageProduct::where('produit_id', $product->id)
            ->get()
            ->map(function ($image) {
                return asset('uploads/' . $image->image);
            });

        $formattedProducts[] = [
            'id' => $product->id,
            'nom_produit' => $product->nom_produit,
            'description' => $product->description,
            'images' => $formattedImages,
            'added' => Carbon::parse($product->created_at)->diffForHumans(),
        ];
    }

    return response()->json(['produits' => $formattedProducts]);
}
//home produits
public function afficherNonProduitsParUtilisateur($iduser)
{
    $products = Produit::where('user_id', '!=', $iduser)->where('visibility', '1')->get();

    $formattedProducts = [];
    $products = $products->sortByDesc('created_at');

    foreach ($products as $product) {
        $formattedImages = ImageProduct::where('produit_id', $product->id)
            ->get()
            ->map(function ($image) {
                return asset('uploads/' . $image->image);
            });

        $formattedProducts[] = [
            'id' => $product->id,
            'nom_produit' => $product->nom_produit,
            'description' => $product->description,
            'images' => $formattedImages,
            'added' => Carbon::parse($product->created_at)->diffForHumans(),
        ];
    }

    return response()->json(['produits' => $formattedProducts]);
}
//delete produit
public function deleteProduit($idproduit){
    $produit = Produit::find($idproduit);
    $produit->delete();
    return response()->json(['produits' => $produit]);
}
//affichage produits par categorie
public function afficherProduitsParCategorie($user_id,$categorie_id)
{
    // Validate if the category exists
    $categorie = Categorie::find($categorie_id);
    if (!$categorie) {
        return response()->json(['message' => 'Catégorie non trouvée'], 404);
    }

    // Fetch products with the specified category ID
    $products = Produit::where('categorie_id', $categorie_id)->where('visibility', '1')->where('user_id', '!=', $user_id)->get();

    // Format the products
    $formattedProducts = [];

    foreach ($products as $product) {
        $formattedImages = ImageProduct::where('produit_id', $product->id)
            ->get()
            ->map(function ($image) {
                return asset('uploads/' . $image->image);
            });

        $formattedProducts[] = [
            'id' => $product->id,
            'nom_produit' => $product->nom_produit,
            'description' => $product->description,
            'images' => $formattedImages,
    
            'added' => Carbon::parse($product->created_at)->diffForHumans(),
        ];
    }

    return response()->json(['produits' => $formattedProducts]);
}

public function updateProduit(Request $request, $id)
{
    try {
        // Validation des champs
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id' // Validate if the category exists
        ]);
    } catch (ValidationException $e) {
        // Handle validation errors
        return response()->json(['errors' => $e->validator->errors()], 422);
    }

    // Find the product by ID
    $produit = Produit::find($id);

    // Check if the product exists
    if (!$produit) {
        return response()->json(['message' => 'Produit non trouvé'], 404);
    }

    // Update the product attributes
    $produit->nom_produit = $request->input('nom_produit');
    $produit->description = $request->input('description');
    $produit->categorie_id = $request->input('categorie_id');

    // Save the updated product
    $produit->save();

    return response()->json(['message' => "Produit mis à jour avec succès", 'idproduit' => $produit->id]);
}
//reset produit
public function ResetProduit($idprod)
{
    
    $produit = Produit::find($idprod);
    // Check if the product exists
    if (!$produit) {
        return response()->json(['message' => 'Produit non trouvé'], 404);
    }
    $produit->visibility = '1';
    $produit->save();
    Offre::where('produitcible_id', $idprod)->delete();

    return response()->json(['message' => "Produit Reset ", 'idproduit' => $produit->id]);
}
 
}
