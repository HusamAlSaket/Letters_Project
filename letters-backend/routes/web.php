<?php

use App\Http\Controllers\PhonemeActivityController;
use App\Http\Controllers\PhonemeCharacteristicController;
use App\Http\Controllers\PhonemeContextualFeatureController;
use App\Http\Controllers\PhonemeDeletionController;
use App\Http\Controllers\PhonemeEmbeddingController;
use App\Http\Controllers\PhonemeGrammaticalRoleController;
use App\Http\Controllers\PhonemeMorphemeController;
use App\Http\Controllers\PhonemeFunctionController;
use App\Http\Controllers\PhonemeNatureController;
use App\Http\Controllers\PhonemeOriginController;
use App\Http\Controllers\PhonemeOverviewController;
use Illuminate\Support\Facades\Route;

$controllers = [
    'phoneme-activities' => PhonemeActivityController::class,
    'phoneme-characteristics' => PhonemeCharacteristicController::class,
    'phoneme-contextuals' => PhonemeContextualFeatureController::class,
    'phoneme-deletions' => PhonemeDeletionController::class,
    'phoneme-functions' => PhonemeFunctionController::class,
    'phoneme-embeddings' => PhonemeEmbeddingController::class,
    'phoneme-grammatical-roles' => PhonemeGrammaticalRoleController::class,
    'phoneme-morphemes' => PhonemeMorphemeController::class,
    'phoneme-natures'=> PhonemeNatureController::class,
    'phoneme-origins'=> PhonemeOriginController::class,
    'phoneme-overview'=> PhonemeOverviewController::class,
];

foreach ($controllers as $prefix => $controller) {
    // Resource routes for each controller
    Route::resource($prefix, $controller)->only(['index','show','update', 'destroy']);
}
