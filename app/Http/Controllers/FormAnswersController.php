<?php

namespace App\Http\Controllers;

use App\Models\FormAnswers;
use Illuminate\Http\JsonResponse;

class FormAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(FormAnswers::getCurrentFormAnswers());
    }

}
