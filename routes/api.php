<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskApiController::class, 'index']);
    Route::post('/tasks', [TaskApiController::class, 'store']);
    Route::get('/tasks/{task}', [TaskApiController::class, 'show']);
    Route::put('/tasks/{task}', [TaskApiController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskApiController::class, 'destroy']);
    Route::get('/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });
});

Route::post('/login', function (Illuminate\Http\Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();
    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    $token = $user->createToken('taskflow-token')->plainTextToken;
    return response()->json(['token' => $token, 'user' => $user]);
});