<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = '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';
    }

    /**
     * Mengirimkan permintaan ke API GPT untuk mendapatkan jawaban dari AI
     *
     * @param string $prompt
     * @return array
     */
    public function askQuestion($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo', // atau model GPT lainnya yang ingin digunakan
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        // Mengembalikan jawaban dari AI
        return $response->json();
    }
}
