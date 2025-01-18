<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Like Management
 *
 *
 */
class LikeController extends Controller
{
    /**
     * Display a listing of likes.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "user_id": 1,
     *      "blog_id": 1,
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z"
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $likes = Like::all();

        return response()->json(['data' => $likes]);
    }

    /**
     * Store a newly created like in storage.
     *
     * @bodyParam user_id integer required The ID of the user who likes the blog. Example: 1
     * @bodyParam blog_id integer required The ID of the blog being liked. Example: 1
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Like created successfully",
     *  "data": {
     *    "id": 1,
     *    "user_id": 1,
     *    "blog_id": 1,
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 422 scenario="validation error" {
     *  "message": "The blog_id field is required."
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $like = Like::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Like created successfully',
            'data' => $like,
        ], 201);
    }

    /**
     * Display the specified like.
     *
     * @urlParam id integer required The ID of the like. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "id": 1,
     *    "user_id": 1,
     *    "blog_id": 1,
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Like not found."
     * }
     */
    public function show($id)
    {
        $like = Like::findOrFail($id);

        return response()->json(['data' => $like]);
    }

    /**
     * Remove the specified like from storage.
     *
     * @urlParam id integer required The ID of the like. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Like deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Like not found."
     * }
     */
    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return response()->json([
            'success' => true,
            'message' => 'Like deleted successfully',
        ]);
    }
}
