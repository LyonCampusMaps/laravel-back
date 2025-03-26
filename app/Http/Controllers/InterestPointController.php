<?php

namespace App\Http\Controllers;

use App\Models\InterestPoint;
use Illuminate\Http\JsonResponse;

class InterestPointController extends Controller
{
    public function show(InterestPoint $interestPoint): JsonResponse
    {
        return response()->json($interestPoint->load('category'));
    }

    public function index(): JsonResponse
    {
        return response()->json(InterestPoint::all()->load('category')->flatten());
    }
}
