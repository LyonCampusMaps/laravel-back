<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function show(Blog $blog): JsonResponse
    {
        $blog = $blog->toArray();
        $blog['encoded_image'] = $this->getBase64Image($blog['image']);

        return response()->json($blog);
    }

    public function index(): JsonResponse
    {
        $blogs = Blog::all()->map(function ($blog) {
            $blog->encoded_image = $this->getBase64Image($blog->image);
            return $blog;
        });

        return response()->json($blogs);
    }

    private function getBase64Image($imagePath): ?string
    {
        if (file_exists(storage_path('app/public/' . $imagePath))) {
            $imageContent = file_get_contents(storage_path('app/public/' . $imagePath));
            return base64_encode($imageContent);
        }

        return null;
    }
}
