<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Category Management
 *
 *
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Programming",
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z"
     *    },
     *    {
     *      "id": 2,
     *      "name": "Design",
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z"
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json(['data' => $categories]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @bodyParam name string required The name of the category. Example: Programming
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Category created successfully",
     *  "data": {
     *    "id": 3,
     *    "name": "Programming",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 422 scenario="validation error" {
     *  "message": "The name field is required."
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified category.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "id": 1,
     *    "name": "Programming",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Category not found."
     * }
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified category in storage.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     * @bodyParam name string required The name of the category. Example: Programming Updated
     *
     * @response 200 scenario="updated" {
     *  "success": true,
     *  "message": "Category updated successfully",
     *  "data": {
     *    "id": 1,
     *    "name": "Programming Updated",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:30:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Category not found."
     * }
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Category deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Category not found."
     * }
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
