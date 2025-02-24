<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('quantity', 'desc')->get(); // Eager load the category
        return view('products', ['products' => $products]);
    }
    // public function index()
    // {
    //     $products = Product::orderBy('quantity', 'desc')->get(); // Order by quantity descending
    //     return view('products', ['products' => $products]);
    // }

    public function create(Request $request)
    {
        // Fetch categories from the database
        $categories = Category::all();

        // If the request is a POST request, handle form submission
        if ($request->isMethod('post')) {
            $incomingField = $request->validate([
                'title' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('products', 'title')],
                'price' => ['required', 'numeric', 'min:0'],
                'status' => ['nullable', 'in:0,1'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'order' => ['nullable', 'numeric'],
                'category_id' => ['required', 'exists:categories,id'],
            ]);

            $incomingField['status'] = isset($request->status) ? (bool) $request->status : false;
            $incomingField['order'] = $request->filled('order') ? $request->order : 0;

            try {
                Product::create($incomingField);
                return redirect()->route('products.display')->with('success', 'Product added successfully!');
            } catch (\Exception $e) {
                Log::error('Product creation failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Product creation failed. Please try again.');
            }
        }

        // If the request is a GET request, display the form with categories
        return view('productform', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('edit-product', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $incomingField = $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('products', 'title')->ignore($product->id)],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:0,1'], // Ensure status is either 0 or 1
            'quantity' => ['required', 'numeric', 'min:1'],
            'order' => ['nullable', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        // Update the product in the database
        try {
            $product->update($incomingField);
            return redirect()->route('products.display')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Product update failed. Please try again.');
        }
    }

    public function delete(Product $product)
    {
        try {
            $product->delete();
            return redirect()->action([ProductController::class, 'index']);
        } catch (\Exception $e) {
            Log::error('Product deletion failed: ' . $e->getMessage());
            return redirect()->route('products')->with('error', 'Failed to delete the product');
        }
    }
}