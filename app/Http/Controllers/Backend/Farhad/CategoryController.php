<?php

namespace App\Http\Controllers\Backend\Farhad;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.layouts.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            // 'slug' => 'required|string|unique:categories,slug|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Handle image upload
        if ($request->file('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/categories-images/';
            // ✅ Create directory if it doesn't exist
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }
            // $image->move($directory, $imageName);
            // Resize to 60x60 (image intervention)
            $resizedImage = Image::make($image)->resize(60, 60);
            $resizedImage->save(public_path($directory . $imageName));

            $imageUrl = $directory . $imageName;
        } else {
            $imageUrl = null;
        }

        $category                 = new Category();
        $category->name           = $request->name;
        // $category->slug           = Str::slug($request->name); //slug is handled in model
        $category->image          = $imageUrl;
        $category->status         = $request->status;
        $category->save();
        return back()->with('message', 'New Category information added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.layouts.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id',
            // 'slug' => 'required|string|unique:categories,slug|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Image upload or keep old
        if ($request->file('image')) {
            // Remove existing image if any
            if ($category->image && file_exists($category->image)) {
                unlink($category->image);
            }

            // Upload new image
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/categories-images/';
            // $image->move($directory, $imageName);

            // Resize to 60x60 (image intervention)
            $resizedImage = Image::make($image)->resize(60, 60);
            $resizedImage->save(public_path($directory . $imageName));

            $imageUrl = $directory . $imageName;
        } else {
            $imageUrl = $category->image;
        }

        $category->name           = $request->name;
        // $category->slug           = Str::slug($request->name); //slug is handled in model
        $category->image          = $imageUrl;
        $category->status         = $request->status;
        $category->save();

        return back()->with('message', 'Category information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->slug === 'uncategorized') {
            return redirect()->back()->with('error', 'Cannot delete Uncategorized category.');
        }

        $uncategorizedId = Category::where('slug', 'uncategorized')->first()->id;

        // Reassign products
        Product::where('category_id', $category->id)
            ->update(['category_id' => $uncategorizedId]);

        // Check if image is not null and file exists before unlinking
        if ($category->image && file_exists($category->image)) {
            unlink($category->image);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted and products reassigned.');
    }
}
