<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Tag Management
 *
 *
 */
class TagController extends Controller
{
    /**
     * Display a listing of tags.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Technology",
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z"
     *    }
     *  ]:
     * }
     */
    public function index()
    {
        $tags = Tag::all();

        return response()->json(['data' => $tags]);
    }

    /**
     * Store a newly created tag in storage.
     *
     * @bodyParam name string required The name of the tag. Example: Technology
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Tag created successfully",
     *  "data": {
     *    "id": 1,
     *    "name": "Technology",
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
            'name' => 'required|string|unique:tags,name',
        ]);

        $tag = Tag::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
            'data' => $tag,
        ], 201);
    }

    /**
     * Display the specified tag.
     *
     * @urlParam id integer required The ID of the tag. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "id": 1,
     *    "name": "Technology",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Tag not found."
     * }
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return response()->json(['data' => $tag]);
    }

    /**
     * Update the specified tag in storage.
     *
     * @urlParam id integer required The ID of the tag. Example: 1
     * @bodyParam name string required The new name of the tag. Example: Science
     *
     * @response 200 scenario="updated" {
     *  "success": true,
     *  "message": "Tag updated successfully",
     *  "data": {
     *    "id": 1,
     *    "name": "Science",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:05:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Tag not found."
     * }
     * @response 422 scenario="validation error" {
     *  "message": "The name field is required."
     * }
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully',
            'data' => $tag,
        ]);
    }

    /**
     * Remove the specified tag from storage.
     *
     * @urlParam id integer required The ID of the tag. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Tag deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Tag not found."
     * }
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully',
        ]);
    }
}
