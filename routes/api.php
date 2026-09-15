<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;



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

Route::get('/test-route', function () {
    return response()->json(['message' => 'Routing is working!']);
});

Route::get('/userList', function () {

    return User::select('name', 'email')->get();
});


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/chat-messages/{code}', [App\Http\Controllers\ChatController::class, 'allChatMessages']);

    Route::post('/chat-messages/{code}', [App\Http\Controllers\ChatController::class, 'storeChatMessage']);

    Route::post('/lobby/join/{code}', [App\Http\Controllers\LobbyController::class, 'joinLobby']);

    Route::post('/lobby/leave/{code}', [App\Http\Controllers\LobbyController::class, 'leaveLobby']);

    Route::post("/logout",[AuthController::class,'logout']);

});




Route::post('/login', [AuthController::class, 'login']);        


// Route::get('/test-auth', function () {
//     return response()->json([
//         'authenticated' => Auth::check(),
//         'user' => Auth::user(),
//         'session_id' => session()->getId(),
//     ]);
// });


// Route::post('/test-broadcast-auth', function (Request $request) {
//     return response()->json([
//         'authenticated' => Auth::check(),
//         'user' => Auth::user(),
//         'session_id' => session()->getId(),
//         'body' => $request->all(),
//     ]);
// });
