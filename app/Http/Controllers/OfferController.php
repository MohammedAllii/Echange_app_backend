<?php

// app/Http/Controllers/OfferController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Offre;
use App\Models\User;
use App\Models\ImageProduct;
use App\Models\Productsoffre;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OfferController extends Controller
{
   
    public function ajouterOffre(Request $request, $iduser, $idproduitcible)
    {
        
        try {
            
            $userExists = User::find($iduser);
            $produitExists = Produit::find($idproduitcible);
    
            if (!$userExists || !$produitExists) {
                throw new \Exception('User or produit not found', 404);
            }
            $getOffre = Offre::where('user_id', $iduser)->where('produitcible_id', $idproduitcible)->first();
            $joinedProductIds = $request->input('product_ids');
            $productIds = explode(',', $joinedProductIds);
            if ($getOffre) {
                return response()->json(['message' => "Offre already exists"], 401);
            } else {
                $offre = new Offre();
                $offre->user_id = $iduser;
                $offre->status = '1';
                $offre->produitcible_id = $idproduitcible;
                $offre->save();
                foreach ($productIds as $productId) {
                   // $productsoffre = new Productsoffre();  
                    //$productsoffre->produit_id=intval($productId);
                    //$productsoffre->offre_id=intval($offre->id);
                    //$productsoffre->save();
                    DB::insert('INSERT INTO productsoffre (produit_id, offre_id) VALUES (?, ?)', [$productId, $offre->id]);
                    
                }
                return response()->json(['message' => "Offre ajouté avec succès"], 201);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
        
        
    }



    public function getOffersForProduct($productId)
    {
        $offers = Offre::where('produitcible_id', $productId)->get();
        $offersformat = [];
        foreach ($offers as $offer) {
            
            $Useroffer = User::find($offer->user_id);
            $offersformat[] = [
                'id' => $offer->id,
                'id_user' => $offer->user_id,
                'user_fullname' => $Useroffer->name,
                'status' => $offer->status,
                'added' => Carbon::parse($offer->created_at)->diffForHumans(),
            ];
        }
        return response()->json(['offers' => $offersformat], 200);
    }
    public function getOffersForUser($userId)
    {
        $offers = Offre::where('user_id', $userId)->get();
        $offersformat = [];
        foreach ($offers as $offer) {
            
            $ProduitCible = Produit::find($offer->produitcible_id);
            $Useroffer = User::find($offer->user_id);
            $offersformat[] = [
                'id' => $offer->id,
                'id_user' => $offer->user_id,
                'user_fullname' => $ProduitCible->nom_produit,
                'status' => $offer->status,
                'added' => Carbon::parse($offer->created_at)->diffForHumans(),
            ];
        }
        return response()->json(['offers' => $offersformat], 200);
    }
    public function getProductsForOffer($offerId)
    {
        $Prods = Productsoffre::where('offre_id', $offerId)->get();  
        $formattedProducts = [];

    foreach ($Prods as $product) {
      /*
        $Produitadedd = Produit::find($product->produit_id);

        $formattedProducts[] = [
            'id' => $Produitadedd->id,
            'nom_produit' => $Produitadedd->nom_produit,
        ];
        */
        $Pruoditadedd = Produit::find($product->produit_id);
        $formattedImages = ImageProduct::where('produit_id', $Pruoditadedd->id)
        ->get()
        ->map(function ($image) {
            return asset('images/' . $image->image);
        });

    $formattedProducts[] = [
        'id' => $Pruoditadedd->id,
        'nom_produit' => $Pruoditadedd->nom_produit,
        'description' => $Pruoditadedd->description,
        'images' => $formattedImages,
        'added' => Carbon::parse($Pruoditadedd->created_at)->diffForHumans(),
    ];
    }
    return response()->json(['produits' => $formattedProducts]);

    }

    public function acceptOffer($offerId)
    {
        try {
            $offer = Offre::findOrFail($offerId);
            $offer->status = 2;
            $offer->save();
            Offre::where('produitcible_id', $offer->produitcible_id)->where('id', '!=', $offerId)->delete();
            $Prod= Produit::where('id', $offer->produitcible_id)->first();
            $Prod->visibility= '0';
            $Prod->save();

            return response()->json(['message' => 'Offer accepted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function declineOffer($offerId)
    {
        try {
            $offer = Offre::findOrFail($offerId);
            $offer->delete();

            return response()->json(['message' => 'Offer declined successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
    
    
}

