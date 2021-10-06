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

Route::get('/', 'HomeController@index')->middleware('guest');


/*
Route::get('cvs','CvController@index');
Route::get('cvs/create','CvController@create');
Route::post('cvs','CvController@store');
Route::get('cvs/{id}/edit','CvController@edit');
Route::put('cvs/{id}','CvController@update');
Route::delete('cvs/{id}','CvController@destroy');
Route::get('cvs/{id}','CvController@show');
*/

// Route::get('/NewAccount', function () {
//     return view('auth.register');
// });





Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('event/add','HomeController@store');
Route::get('/getevents', 'HomeController@getEvents');
Route::delete('/deleteevent/{id}','HomeController@deleteEvent');

Route::get('/newUser', 'UserController@newUser');
Route::post('/addUser', 'UserController@addUser');
Route::get('/users', 'UserController@getUsers');
Route::delete('/deleteuser/{id}','UserController@deleteUser');
Route::get('/userhome/{id}', 'UserController@goToUserHome');



Route::get('/absences', 'AbsenceController@index');
Route::get('/getusers', 'AbsenceController@getUsers');
Route::post('/addabsence', 'AbsenceController@addAbsence');
Route::get('/getabsences', 'AbsenceController@getAbsences');
Route::delete('/deleteabsence/{id}','AbsenceController@deleteAbsence');

Route::get('/tests', 'TestController@index');
Route::get('/getjoueurs', 'TestController@getJoueurs');
Route::post('/addtest', 'TestController@addTest');
Route::get('/gettests', 'TestController@getTests');
Route::delete('/deletetest/{id}','TestController@deleteTest');


Route::get('/profileuser', 'UserController@profileUser');
Route::post('/updateuser', 'UserController@updateUser');




