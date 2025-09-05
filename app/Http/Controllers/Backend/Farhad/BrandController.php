<?php

namespace App\Http\Controllers\Backend\Farhad;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('backend.layouts.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:brands,name|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Handle image upload
        if ($request->file('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/brands-images/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
        } else {
            $imageUrl = null;
        }

        $brand = new Brand();
        $brand->name   = $request->name;
        // $brand->slug = Str::slug($request->name); // slug handled in model
        $brand->image  = $imageUrl;
        $brand->status = $request->status;
        $brand->save();

        return back()->with('message', 'New Brand information added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.layouts.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id . ',id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Image upload or keep old
        if ($request->file('image')) {
            if ($brand->image && file_exists($brand->image)) {
                unlink($brand->image);
            }

            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/brands-images/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
        } else {
            $imageUrl = $brand->image;
        }

        $brand->name   = $request->name;
        // $brand->slug = Str::slug($request->name); // slug handled in model
        $brand->image  = $imageUrl;
        $brand->status = $request->status;
        $brand->save();

        return back()->with('message', 'Brand information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->slug === 'unbranded') {
            return redirect()->back()->with('error', 'Cannot delete Unbranded brand.');
        }

        $unbrandedId = Brand::where('slug', 'unbranded')->first()->id;

        // Reassign products
        Product::where('brand_id', $brand->id)
            ->update(['brand_id' => $unbrandedId]);

        // Delete image if exists
        if ($brand->image && file_exists($brand->image)) {
            unlink($brand->image);
        }

        $brand->delete();

        return redirect()->back()->with('success', 'Brand deleted and products reassigned.');
    }
}
