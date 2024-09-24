<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class AIController extends Controller
{
    protected $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    public function askAI(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $response = $this->openAI->askQuestion($request->input('question'));

        return response()->json($response);
    }
}
