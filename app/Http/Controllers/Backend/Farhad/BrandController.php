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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

        $brand->delete();

        return redirect()->back()->with('success', 'Brand deleted and products reassigned.');
    }
}
