<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GeminiController extends Controller
{

public function chat(Request $request)
{
    $apiKey = env('GEMINI_API_KEY');

    $client = new Client();

    $response = $client->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $request->input('message', 'Hello Gemini!')
                        ]
                    ]
                ]
            ]
        ]
    ]);

    $body = json_decode($response->getBody(), true);
    \Log::info('Gemini response:', $body); // ← Log it

    $replyText = $body['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

    return response()->json(['reply' => $replyText]);
}

}