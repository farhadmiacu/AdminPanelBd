<?php

namespace App\Http\Controllers\Backend\Farhad;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('backend.layouts.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.layouts.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:products,name|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'code' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|lte:regular_price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        // Handle image upload
        $imageUrl = null; // default

        if ($request->file('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/products-images/';
            // Create directory if it doesn't exist
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }
            $resizedImage = Image::make($image)->resize(300, 300); // Resize to 300x300
            $resizedImage->save(public_path($directory . $imageName));
            $imageUrl = $directory . $imageName;
        }



        $product = new Product();
        $product->name = $request->name;
        // $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->code = $request->code;
        $product->image = $imageUrl;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->regular_price = $request->regular_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->save();

        return back()->with('message', 'New Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('backend.layouts.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.layouts.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'code' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|lte:regular_price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        // Image upload or keep old
        $imageUrl = $product->image; // default: keep old image
        if ($request->file('image')) {
            if ($product->image && file_exists($product->image)) {
                unlink($product->image);
            }

            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/products-images/';
            $resizedImage = Image::make($image)->resize(300, 300);
            $resizedImage->save(public_path($directory . $imageName));
            $imageUrl = $directory . $imageName;
        }
        // Check if Dropify removed the image
        elseif ($request->input('image') === null) {
            // Delete old image
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageUrl = null;
        }

        $product->name = $request->name;
        // $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->code = $request->code;
        $product->image = $imageUrl;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->regular_price = $request->regular_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->save();

        return back()->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Remove image if exists
        if ($product->image && file_exists($product->image)) {
            unlink($product->image);
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
