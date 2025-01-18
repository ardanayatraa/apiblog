<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Media Management
 *
 *
 */
class MediaController extends Controller
{
    /**
     * Display a listing of media.
     *
     * @response 200 scenario="success" {
     *  "data": [
     *    {
     *      "id": 1,
     *      "url": "https://example.com/media/image1.jpg",
     *      "type": "image",
     *      "created_at": "2025-01-18T12:00:00.000000Z",
     *      "updated_at": "2025-01-18T12:00:00.000000Z"
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $media = Media::all();

        return response()->json(['data' => $media]);
    }

    /**
     * Store a newly created media in storage.
     *
     * @bodyParam url string required The URL of the media. Example: https://example.com/media/image1.jpg
     * @bodyParam type string required The type of the media (e.g., image, video, document). Example: image
     *
     * @response 201 scenario="created" {
     *  "success": true,
     *  "message": "Media created successfully",
     *  "data": {
     *    "id": 1,
     *    "url": "https://example.com/media/image1.jpg",
     *    "type": "image",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 422 scenario="validation error" {
     *  "message": "The url field is required."
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|url',
            'type' => 'required|string',
        ]);

        $media = Media::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Media created successfully',
            'data' => $media,
        ], 201);
    }

    /**
     * Display the specified media.
     *
     * @urlParam id integer required The ID of the media. Example: 1
     *
     * @response 200 scenario="success" {
     *  "data": {
     *    "id": 1,
     *    "url": "https://example.com/media/image1.jpg",
     *    "type": "image",
     *    "created_at": "2025-01-18T12:00:00.000000Z",
     *    "updated_at": "2025-01-18T12:00:00.000000Z"
     *  }
     * }
     * @response 404 scenario="not found" {
     *  "message": "Media not found."
     * }
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);

        return response()->json(['data' => $media]);
    }

    /**
     * Remove the specified media from storage.
     *
     * @urlParam id integer required The ID of the media. Example: 1
     *
     * @response 200 scenario="deleted" {
     *  "success": true,
     *  "message": "Media deleted successfully"
     * }
     * @response 404 scenario="not found" {
     *  "message": "Media not found."
     * }
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media deleted successfully',
        ]);
    }
}
