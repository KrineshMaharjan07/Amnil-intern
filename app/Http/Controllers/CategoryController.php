<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all(); // Fetch all categories from the database
        // return view('categories', ['categories' => $categories]);

        $categories = Category::orderBy('created_at', 'desc')->get(); // Order by created_at descending
        return view('categories', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $incomingfield = $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('categories', 'title')],
        ]);
        try {
            // Create the product in the database
            Category::create([
                'title' => $incomingfield['title'],
            ]);
            return redirect()->action([CategoryController::class, 'index']);

        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage()); // Log error
            return response()->json([
                'message' => 'Fail',
                'error' => $e->getMessage() // Show exact reason for failure
            ], 500);
        }
    }

    public function edit(Category $categories)
    {
        return view('edit-categories', ['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categories)
    {
        //// Debug incoming request (check in Laravel logs)
        Log::info('Update request received:', $request->all());

        // Validate input
        $incomingField = $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('categories', 'title')],
        ]);

        try {
            // Update categories in database
            $categories->update($incomingField);

            return redirect()->action([CategoryController::class, 'index']);
        } catch (\Exception $e) {
            Log::error('Categories update failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Category $categories)
    {
        try {
            $categories->delete(); // Delete product

            return redirect()->action([CategoryController::class, 'index']);
        } catch (\Exception $e) {
            Log::error('Product deletion failed: ' . $e->getMessage());

            return redirect()->action([CategoryController::class, 'index'])->with('error', 'Failed to delete the product');
        }
    }
}
