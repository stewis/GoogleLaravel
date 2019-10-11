<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend');
});

Route::group([
    'prefix'    => 'backend',
    'namespace' => 'BackEnd'
], function() {
    Route::get('/', [
        'as'    => 'backend.index',
        'uses'  => 'BackendController@index'
    ]);
    Route::get('/location/{address}/edit', [
        'as'    => 'backend.location.edit',
        'uses'  => 'BackendController@edit'
    ]);
    Route::post('/location/{address}/edit/save', [
        'as'    => 'backend.location.update',
        'uses'  => 'BackendController@update'
    ]);
    Route::get('/location/new', [
        'as'    => 'backend.location.new',
        'uses'  => 'BackendController@new'
    ]);
    Route::post('/location/save', [
        'as'    => 'backend.location.create',
        'uses'  => 'BackendController@create'
    ]);
    Route::get('/location/{address}/delete', [
        'as'    => 'backend.location.delete',
        'uses'  => 'BackendController@deleteConfirmation'
    ]);
    Route::post('/location/{address}/delete/confirmed', [
        'as'    => 'backend.location.delete.confirm',
        'uses'  => 'BackendController@delete'
    ]);
});
