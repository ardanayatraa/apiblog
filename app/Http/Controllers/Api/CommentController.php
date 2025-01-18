<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Comment Management
 *
 *
 */
class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "content": "This is a comment.",
     *      "author_id": 1,
     *      "blog_id": 1,
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z",
     *      "author": {
     *        "id": 1,
     *        "name": "John Doe"
     *      },
     *      "blog": {
     *        "id": 1,
     *        "title": "First Blog"
     *      }
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $comments = Comment::with('author', 'blog')->get();

        return response()->json(['data' => $comments]);
    }

    /**
     * Store a newly created comment in storage.
     *
     * @bodyParam content string required The content of the comment. Example: This is a comment.
     * @bodyParam author_id integer required The ID of the author. Example: 1
     * @bodyParam blog_id integer required The ID of the blog. Example: 1
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Comment created successfully",
     *  "data": {
     *    "id": 1,
     *    "content": "This is a comment.",
     *    "author_id": 1,
     *    "blog_id": 1,
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 422 scenario="validation error" {
     *  "message": "The content field is required."
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $comment = Comment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Comment created successfully',
            'data' => $comment,
        ], 201);
    }

    /**
     * Display the specified comment.
     *
     * @urlParam id integer required The ID of the comment. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "id": 1,
     *    "content": "This is a comment.",
     *    "author_id": 1,
     *    "blog_id": 1,
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z",
     *    "author": {
     *      "id": 1,
     *      "name": "John Doe"
     *    },
     *    "blog": {
     *      "id": 1,
     *      "title": "First Blog"
     *    }
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Comment not found."
     * }
     */
    public function show($id)
    {
        $comment = Comment::with('author', 'blog')->findOrFail($id);

        return response()->json(['data' => $comment]);
    }

    /**
     * Update the specified comment in storage.
     *
     * @urlParam id integer required The ID of the comment. Example: 1
     * @bodyParam content string required The updated content of the comment. Example: Updated comment content.
     *
     * @response 200 scenario="updated" {
     *  "success": true,
     *  "message": "Comment updated successfully",
     *  "data": {
     *    "id": 1,
     *    "content": "Updated comment content.",
     *    "author_id": 1,
     *    "blog_id": 1,
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:30:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Comment not found."
     * }
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully',
            'data' => $comment,
        ]);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @urlParam id integer required The ID of the comment. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Comment deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Comment not found."
     * }
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully',
        ]);
    }
}
