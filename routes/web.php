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
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/editUser/{id}', function () {
    return view('user-edit');
});

Route::view('/home','home')->name('home page');
// Route::get('/home', function(){
//     return view('home');
// });

Route::post('/user/login', 'UserController@Login');
Route::post('/user/edit/{id}', 'UserController@Edit');
Route::get('/deleteUser/{id}', 'UserController@Delete');
Route::get('/cadastraEvento', 'EventoController@Index');
Route::post('/registerEvent', 'EventoController@Store');
Route::get('/viewEvents', 'EventoController@Show');
Route::post('/registeruser', 'UserController@Register');

Route::get('editaEvento', ['as' => 'evento.edita', 'uses' => 'EventoController@Edita']);
Route::get('excluiEvento', ['as' => 'evento.exclui', 'uses' => 'EventoController@Exclui']);
Route::get('cancelaEvento', ['as' => 'evento.cancela', 'uses' => 'EventoController@Cancela']);
Route::get('inscrever', ['as' => 'participant.inscreve', 'uses' => 'PessoaController@Inscreve']);

