<?php

use App\Http\Controllers\API\Groups\CreateGroupController;
use App\Http\Controllers\API\Groups\DeleteGroupController;
use App\Http\Controllers\API\Groups\ListGroupsController;
use App\Http\Controllers\API\Groups\ListAllGroupsController;
use App\Http\Controllers\API\Groups\RetrieveGroupController;
use App\Http\Controllers\API\Groups\UpdateGroupController;
use App\Http\Controllers\API\Users\AttachUserToGroupController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\Users\CreateUserController;
use App\Http\Controllers\API\Users\DeleteUserController;
use App\Http\Controllers\API\Users\ListUsersController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\Users\RetrieveUserController;
use App\Http\Controllers\API\Users\UpdateUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sign-in', AuthenticationController::class);
Route::post('/sign-out', LogoutController::class);
        
Route::prefix('v1')
    ->group(function () {
        // Public User Endpoints
        Route::get('/users', ListUsersController::class);
        Route::get('/users/{id}', RetrieveUserController::class);

        // Public Group Endpoints
        Route::get('/groups', ListGroupsController::class);
        Route::get('/groups/all', ListAllGroupsController::class);
        Route::get('/groups/{id}', RetrieveGroupController::class);

        Route::middleware('auth:api')
            ->group(function () {
                // User Endpoints
                Route::post('/users', CreateUserController::class);
                Route::post('/users/{id}/group', AttachUserToGroupController::class);
                Route::put('/users/{id}', UpdateUserController::class);
                Route::delete('/users/{id}', DeleteUserController::class);

                // Group Endpoints
                Route::post('/groups', CreateGroupController::class);
                Route::put('/groups/{id}', UpdateGroupController::class);
                Route::delete('/groups/{id}', DeleteGroupController::class);
            });  
    });
