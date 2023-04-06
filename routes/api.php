<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orhanerday\OpenAi\OpenAi;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/openai', function (Request $request) {
    $openai = new OpenAi(config('app.open_ai')); //
     
     $complete = $openai->completion([
        'model' => 'text-davinci-002',
        'prompt' => 'Hello My name is',
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
     ]);
    // json string to array php
    $complete = json_decode($complete, true);
    return $complete['choices'][0]['text'];
});

Route::post('/post-blog', function (Request $request){
    $idea = $request->input('idea') ?? null;
    $industry = $request->input('industry') ?? null;
    $length = $request->input('length') ?? null;
    $tone = $request->input('tone') ?? null;
    $titleSlug = $request->input('titleSlug') ?? null;
    $catchyDescription = $request->input('catchyDescription') ?? null;
    $keywords = $request->input('keywords') ?? null;
    $metaDescription = $request->input('metaDescription') ?? null;

    $query = "Generate an SEO-optimized blog post HTML about";
    if ($idea) {
        $query .= " $idea";
    }
    if ($industry) {
        $query .= " in the $industry industry";
    }
    if ($length) {
        $query .= ". Approx. $length words.";
    }
    if ($tone) {
        $query .= " $tone tone.";
    }
    if ($titleSlug && $catchyDescription) {
        $query .= " Catchy title ($titleSlug) & description ($catchyDescription).";
    }
    if ($keywords) {
        $query .= " Use relevant keywords ($keywords) for search engine optimization.";
    }
    if ($metaDescription) {
        $query .= " Meta description ($metaDescription).";
    }

    $openai = new OpenAi(config('app.open_ai')); //

    $complete = $openai->completion([
        'model' => 'text-davinci-002',
        'prompt' => $query,
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
     ]);
    // json string to array php
    $complete = json_decode($complete, true);
    return $complete['choices'][0]['text'];
});