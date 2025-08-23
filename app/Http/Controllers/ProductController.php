<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fetch all
         $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * postgresql://postgres:[YOUR-PASSWORD]@db.ezejraknspitwljhvjvh.supabase.co:5432/postgres  postgresql://paschal:AXpXW4CbgcouzIdETFA2KrlSc36R0sQj@dpg-d2l0v6re5dus738cbung-a/product_crud_ulzx
     * Show the form for creating a new resource.  https://app.planetscale.com/  3306  product_crud paschal1  Paschal@081  postgresql://paschal:AXpXW4CbgcouzIdETFA2KrlSc36R0sQj@dpg-d2l0v6re5dus738cbung-a.oregon-postgres.render.com/product_crud_ulzx
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //add products
      $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted!');
}

    
}
