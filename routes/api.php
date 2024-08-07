<?php

use App\Events\DoStep;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', 'UserController@getUser');


Route::get('/web3-login-message', 'Web3LoginController@message');

Route::get('/get-users', 'UserController@getUsers');
Route::get('/active-sessions', 'UserController@getActiveSessions');


Route::post('/if-there-nft', 'Web3LoginController@IfThereNft');
Route::post('/nft-Collection', 'Web3LoginController@NftCollection');
