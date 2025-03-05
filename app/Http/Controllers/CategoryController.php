<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function index(): JsonResponse
    {
        return response()->json(Category::all()->flatten());
    }
}
