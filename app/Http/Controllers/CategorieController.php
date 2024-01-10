<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Flash;



class CategorieController extends Controller {
    // Add a method to show the category creation form
    public function create() {
        return view('categories.create');
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'categorie_name' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $category = new Categorie();
    $category->categorie_name = $request->input('categorie_name');

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('category_images', 'public');
        $category->image = $imagePath;
    }

    $category->save();

    // Include success flag and message in the response
    return response()->json(['message' => 'Category created successfully', 'success' => true], 201);
}


    public function afficherallCategories()
{
    $categories = Categorie::all();

    $formattedCategories = [];

    foreach ($categories as $category) {
        // Assuming `image` is the column in the `categories` table
        $categoryImage = $category->image;

        // Build the complete URL for the category image
        $categoryImageUrl = $categoryImage ? url('uploads/' . $categoryImage) : null;

        $formattedCategories[] = [
            'id' => $category->id,
            'categorie_name' => $category->categorie_name, // Adjust the column name if necessary
            'image' => $categoryImageUrl,
            'added' => Carbon::parse($category->created_at)->diffForHumans(),
        ];
    }

    return response()->json(['categories' => $formattedCategories]);
}

public function CategoryRoute()
    {
        return view('categ');
    }
//get all users not banned
public function getAllcategory()
{
    $categorys = Categorie::all();
    return view('categ', compact('categorys'));
}
public function update(Request $request, $id)
{
    // Validate request data if needed

    // Update category logic
    $category = Categorie::find($id);
    $category->categorie_name = $request->input('categorie_name');

    if ($request->hasFile('image')) {
        // Handle image upload
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        // Update category image
        $category->image = $imageName;
    }

    $category->save();

    return response()->json(['success' => true, 'message' => 'Category updated successfully']);
}
}

