<?php

use App\Repositories\GameRepository;
use App\Repositories\MemberRepository;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $repo = new GameRepository;
    return $repo->find("caf07df0-b3f8-11ee-9c56-332d7b9554c7")->scores;
});

Route::get('/members', [MemberRepository::class, 'listAllMembers']);
Route::get('/game/{guid}', [GameRepository::class, 'viewGame']);

Route::prefix('member')->group(function () {
    Route::get('/{guid}', [MemberRepository::class, 'viewMember']);
    Route::get('/{guid}/edit', [MemberController::class, 'viewEditMemberPage']);
});

// This allows for easy access to post AJAX updates using Vue rather than using the api route
// Especially in some edge cases using Sanctum Authorisation when domains had to match in nginx
// So this became my default in previous roles as it removed extra config with easy security
// But can also be done via the routes\api.php file as the "correct" Laravel way
Route::prefix('ajax')->group(function () {
    Route::prefix('create')->group(function () {
        Route::post('/member', [MemberRepository::class, 'create']);
        Route::post('/game', [GameRepository::class, 'create']);
    });
    Route::prefix('update')->group(function () {
        Route::post('/member/{id}', [MemberRepository::class, 'update']);
        Route::post('/game/{id}', [GameRepository::class, 'update']);
    });
    Route::prefix('delete')->group(function () {
        // This can be get or post depending on security requirements
        // / using vue post data / loading a get URL dependant on required 
        // spec or usage
        Route::get('/member/{id}', [MemberRepository::class, 'delete']);
        Route::get('/game/{id}', [GameRepository::class, 'delete']);
    });
});
