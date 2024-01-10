<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favoris;
use App\Models\Produit;
use App\Models\ImageProduct;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FavorisController extends Controller
{
    public function ajouterFavoris(Request $request, $iduser, $idproduit)
    {
        try {
            // Validation des champs
    
            // Check if user_id and produit_id exist
            $userExists = User::find($iduser);
            $produitExists = Produit::find($idproduit);
    
            if (!$userExists || !$produitExists) {
                throw new \Exception('User or produit not found', 404);
            }
    
            // Check if favoris already exists
            $getfavoris = Favoris::where('user_id', $iduser)->where('produit_id', $idproduit)->first();
    
            if ($getfavoris) {
                return response()->json(['message' => "Favoris already exists"], 401);
            } else {
                $favoris = new Favoris();
                $favoris->user_id = $iduser;
                $favoris->produit_id = $idproduit;
                $favoris->save();
    
                return response()->json(['message' => "Favoris ajouté avec succès", 'idfavoris' => $favoris->id], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function getFavorisProducts($iduser)
    {
        $favoris = Favoris::with(['produit.images', 'user'])
            ->where('user_id', $iduser)
            ->get();
    
        $formattedProducts = [];
    
        foreach ($favoris as $favori) {
            $formattedImages = ImageProduct::where('produit_id', $favori->produit->id)
                ->get()
                ->map(function ($image) {
                    return asset('images/' . $image->image);
                });
    
            $formattedProducts[] = [
                'id' => $favori->id,
                'nom_produit' => $favori->produit->nom_produit,
                'description' => $favori->produit->description,
                'images' => $formattedImages,
                'added' => Carbon::parse($favori->created_at)->diffForHumans(),
            ];
        }
    
        return response()->json(['produits' => $formattedProducts]);
    }
    


public function countFavoris($iduser) {
    $favoris = Favoris::where('user_id',$iduser)->count();
    return response()->json([$favoris], 201);
}

public function deleteFavoris($idfavoris){
    $favoris = Favoris::find($idfavoris);
    
    if (!$favoris) {
        return response()->json(['message' => 'Favoris not found'], 404);
    }

    $favoris->delete();

    return response()->json(['message' => 'Favoris deleted successfully']);
}




    
}
