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

/**Route::get('/', function () {
    return view('index');
});**/

Route::post('/search', 'frontend@search');
Route::get('/search', 'frontend@search');
Route::post('/getcoordinate','UserWallController@getcordinatexy');


//Route::get('test', function (){ return view("thewall2/testlay");});
Route::get('test', 'UserWallController@test');


Route::get('/', 'frontend@getProgramm');
Route::get('programm', 'frontend@programmInside');
Route::post('/searchcall','frontend@searchCall');
Route::get('/addadif', function () {
    return view('thewall2/loginformsps');
});
Route::get('archive', 'ProgramsDiplom@getArchiveProgramm');
Route::post('/spslogin', 'ProgramsDiplom@loginsps');
Route::post('/adiff', 'ProgramsDiplom@loadadiff');
Route::post('/uploadsps', 'uploadadifController@uploadsps');


Route::post('/sendcompete', 'frontend@sendemail');
Route::get('upload', 'uploadadifController@getForm');
//Route::get('get','uploadadifController@upload');
//Route::post('get','uploadadifController@upload');
//Route::get('test', 'uploadadifController@test');


//Route::controller('getForm','uploadadifController');
Auth::routes();

Route::get('/cabinet', 'UserWallController@getListProgram')->name('cabinet');;
Route::get('/home', 'HomeController@index');
Route::get('edit','UserWallController@editProgram');
Route::post('edit','UserWallController@saveProgram');
Route::get('log','UserWallController@logProgram');


Route::get('open','UserWallController@openProgram');
Route::get('newprogramm', function (){ return view("thewall2/newProgramForm");})->name('createProgramForm');
Route::post('newprogramm', 'UserWallController@createProgram' );

Route::get('close', 'UserWallController@closeProgram');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
        Route::get('/', ['uses' => 'admin\AdminController@show'])->name('admin_index');
        Route::get('del','UserWallController@delProgram');
        Route::get('upload', 'uploadadifController@getForm');
        Route::get('get','uploadadifController@upload');
        Route::post('get','uploadadifController@upload');
        route::get('report','UserWallController@reportComplited');
        route::get('reportoper','frontend@getReport');

        //Route::get('edit','UserWallController@editProgram');
//log close /del

    }
);