<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\ImageProduct;
class ImageController extends Controller
{
    public function getImage($filename)
    {
        $path = public_path('uploads/' . $filename);
        if (file_exists($path)) {
            $file = file_get_contents($path);
            $type = Storage::mimeType('uploads/' . $filename);
            $response = new Response($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

        return response()->json(['error' => 'Image not found'], 404);
    }
    public function uploadImage(Request $request, $productId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the file types and size as needed
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('uploads'), $imageName);

        // Save image information to the database
        $imageProduct = new ImageProduct;
        $imageProduct->produit_id = $productId;
        $imageProduct->image = $imageName;
        $imageProduct->save();

        return response()->json(['success'=>'Image uploaded successfully.']);
    }

    public function deleteImage($imageId)
    {
        try {
            $imageProduct = ImageProduct::find($imageId);

            if (!$imageProduct) {
                return response()->json(['error' => 'Image not found'], 404);
            }

            // Delete the image file from storage
            $imagePath = public_path('uploads/' . $imageProduct->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete the image record from the database
            $imageProduct->delete();

            return response()->json(['success' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete image'], 500);
        }
    }

    
}

