<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this at the top for logging

class laravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::all();
        return view(view: 'laravel-project.index', data: compact(var_name: 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(view: 'laravel-project.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'product_seller' => 'required|string',
            'product_place' => 'required|string',
            'product_description' => 'nullable|string',
            'product_quantity' => 'required|integer',
            'product_image' => 'nullable|mimes:jpg,png|max:2048'
        ]);
    
        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('products', 'public');
            $validated['product_image'] = $path;
        } else {
            $validated['product_image'] = 'products/default-product.jpg';
        }
    

        Products::create($validated);
    
        return redirect()->route('laravel-project.index')->with('success', 'Product added successfully!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // app/Http/Controllers/ProductController.php
    public function update(Request $request, $id)
    {

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_quantity' => 'required|numeric',
            'product_seller' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_description' => 'nullable|string',
            'product_place' => 'nullable|string|max:255',
        ]);
    

        $product = Products::find($id);
    
        if ($product) {
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_quantity = $request->input('product_quantity');
            $product->product_seller = $request->input('product_seller');
            $product->product_description = $request->input('product_description');
            $product->product_place = $request->input('product_place');
            $product->save();
    
            return redirect()->route('laravel-project.index')->with('success', 'Product updated successfully');
        }

        return redirect()->route('laravel-project.index')->with('error', 'Product not found');
    }
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product by its ID
        $product = Products::find($id);
    
        if ($product) {
            // Delete the product from the database
            $product->delete();
    
            // Redirect back with a success message
            return redirect()->route('laravel-project.index')->with('success', 'Product deleted successfully');
        }
    
        // If product not found, redirect back with an error message
        return redirect()->route('laravel-project.index')->with('error', 'Product not found');
    }    
}
