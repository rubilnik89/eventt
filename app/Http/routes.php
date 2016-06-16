<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$app->get('search_events','ArticleController@eventsList');
$app->get('seatgeek','ArticleController@seatgeek');
$app->get('new_user','UsersController@addNewUser');
$app->get('authorization','UsersController@authorization');
