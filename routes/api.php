<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::prefix('auth')->group(function() {
    Route::post('login', function(Request $request) {
        if(Auth::attempt($request->all())) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('login')->plainTextToken;

            return response()->json([
                'code' => 200, 
                'message' => "OK",
                'data' => [
                    'token' => $token,
                ]
            ], 200);
        }else {
            return response()->json([
                'code' => 500, 
                'message' => 'Internal Server Error',
                'message' => 'Invalid Username and Password'
            ]);
        }
    });
});