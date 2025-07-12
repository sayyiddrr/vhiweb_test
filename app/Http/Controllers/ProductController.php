<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 
    // Display Product Function
    public function index(Request $request){
        // Query for product based on ID User
        $vendor = Vendor::where('user_id', $request->user()->id)->firstOrFail();
        return Product::where('vendor_id', $vendor->id)->get();
    }

    // Create Product Function
    public function store(Request $request){
        // Req Validation
        $request->validate([
            'name' => 'required', 
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        // Query for getting vendor based on ID USer
        $vendor = Vendor::where('user_id', $request->user()->id)->firstOrFail();
        $create = Product::create([
            'vendor_id' => $vendor->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            $create,
            'message' => $request->name . ' Successfully Created']);
    }

    // Update Product Function
    public function update(Request $request, $id){
        // Searching vendor & product based on id
        $vendor = Vendor::where('user_id', $request->user()->id)->firstOrFail();
        $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->firstOrFail();

        $product->update($request->only([
            'name', 
            'description', 
            'price']));

        return response()->json([
            $product,
            'message' => 'Successfully Updated Product'
        ]);
    }

    // Delete Product Function
    public function destroy(Request $request, $id){
        $vendor = Vendor::where('user_id', $request->user()->id)->firstOrFail();
        $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->firstOrFail();
        $product->delete();

        return response()->json(['message' => 'Successfully Deleted Product']);
    }
}
