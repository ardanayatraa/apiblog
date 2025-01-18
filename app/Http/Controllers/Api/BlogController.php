<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Blog Management
 *
 */
class BlogController extends Controller
{
    /**
     * Display a listing of blogs.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "uuid": "123e4567-e89b-12d3-a456-426614174000",
     *      "title": "First Blog",
     *      "slug": "first-blog",
     *      "content": "This is the first blog post.",
     *      "author_id": 1,
     *      "category_id": 2,
     *      "tags": [
     *        {
     *          "id": 1,
     *          "name": "Laravel"
     *        }
     *      ],
     *      "category": {
     *        "id": 2,
     *        "name": "Programming"
     *      },
     *      "author": {
     *        "id": 1,
     *        "name": "John Doe"
     *      }
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $blogs = Blog::with(['category', 'tags', 'author'])->get();

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ], 200);
    }

    /**
     * Store a newly created blog in storage.
     *
     * @bodyParam title string required The title of the blog. Example: My First Blog
     * @bodyParam slug string required The unique slug of the blog. Example: my-first-blog
     * @bodyParam content string required The content of the blog. Example: This is the content.
     * @bodyParam category_id integer required The ID of the category. Example: 1
     * @bodyParam author_id integer required The ID of the author. Example: 1
     * @bodyParam tags array Optional array of tag IDs. Example: [1, 2]
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Blog created successfully",
     *  "data": {
     *    "uuid": "123e4567-e89b-12d3-a456-426614174000",
     *    "title": "My First Blog",
     *    "slug": "my-first-blog",
     *    "content": "This is the content.",
     *    "author_id": 1,
     *    "category_id": 1
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:users,id',
        ]);

        $blog = Blog::create($validated);

        if ($request->tags) {
            $blog->tags()->attach($request->tags);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'data' => $blog,
        ], 201);
    }

    /**
     * Display the specified blog.
     *
     * @urlParam id integer required The ID of the blog. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "uuid": "123e4567-e89b-12d3-a456-426614174000",
     *    "title": "My First Blog",
     *    "slug": "my-first-blog",
     *    "content": "This is the content.",
     *    "category": {
     *      "id": 1,
     *      "name": "Programming"
     *    },
     *    "tags": [
     *      {
     *        "id": 1,
     *        "name": "Laravel"
     *      }
     *    ],
     *    "author": {
     *      "id": 1,
     *      "name": "John Doe"
     *    },
     *    "comments": []
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Blog not found"
     * }
     */
    public function show($id)
    {
        $blog = Blog::with(['category', 'tags', 'author', 'comments'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }

    /**
     * Update the specified blog in storage.
     *
     * @urlParam id integer required The ID of the blog. Example: 1
     * @bodyParam title string The title of the blog. Example: My Updated Blog
     * @bodyParam slug string The unique slug of the blog. Example: my-updated-blog
     * @bodyParam content string The content of the blog. Example: Updated content.
     * @bodyParam category_id integer The ID of the category. Example: 2
     * @bodyParam author_id integer The ID of the author. Example: 1
     * @bodyParam tags array Optional array of tag IDs. Example: [1, 2]
     *
     * @response 200 scenario="updated" {
     *  "success": true,
     *  "message": "Blog updated successfully",
     *  "data": {
     *    "uuid": "123e4567-e89b-12d3-a456-426614174000",
     *    "title": "My Updated Blog",
     *    "slug": "my-updated-blog",
     *    "content": "Updated content.",
     *    "author_id": 1,
     *    "category_id": 2
     *  }
     * }
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $blog->id,
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:users,id',
        ]);

        $blog->update($validated);

        if ($request->tags) {
            $blog->tags()->sync($request->tags);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully',
            'data' => $blog,
        ]);
    }

    /**
     * Remove the specified blog from storage.
     *
     * @urlParam id integer required The ID of the blog. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Blog deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Blog not found"
     * }
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully',
        ]);
    }
}
