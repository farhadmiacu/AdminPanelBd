<?php

namespace App\Http\Controllers\Backend\Farhad;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:category,brand,product',
            'id'   => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $model = null;

        switch ($request->type) {
            case 'category':
                $model = Category::findOrFail($request->id);
                break;
            case 'brand':
                $model = Brand::findOrFail($request->id);
                break;
            case 'product':
                $model = Product::findOrFail($request->id);
                break;
        }

        $model->status = $request->status;
        $model->save();

        return response()->json([
            'success' => true,
            'message' => ucfirst($request->type) . ' status updated successfully!'
        ]);
    }
}
