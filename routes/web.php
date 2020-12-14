<?php

use Illuminate\Support\Facades\Route;

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

//Route Inicial

Route::get('/', function () {
    return view('index');})->name('index.index');

//Routes Livros

Route::get('/livros','App\Http\Controllers\LivrosController@index')
    ->name('livros.index');

Route::get('/livros/{id}/show','App\Http\Controllers\LivrosController@show')
    ->name('livros.show');

Route::get('/livros/create','App\Http\Controllers\LivrosController@create')
    ->name('livros.create')->middleware('auth');

Route::post('/livros/store','App\Http\Controllers\LivrosController@store')
    ->name('livros.store')->middleware('auth');

Route::get('/livros/{id}/edit','App\Http\Controllers\LivrosController@edit')
    ->name('livros.edit')->middleware('auth');

Route::patch('/livros/{id}/update','App\Http\Controllers\LivrosController@update')
    ->name('livros.update')->middleware('auth');

Route::get('/livros/{id}/deleted','App\Http\Controllers\LivrosController@deleted')
    ->name('livros.deleted')->middleware('auth');

Route::delete('/livros/{id}/destroy','App\Http\Controllers\LivrosController@destroy')
    ->name('livros.destroy')->middleware('auth');

Route::get('/livros/{id}/likes','App\Http\Controllers\LivrosController@likes')
    ->name('livros.likes');

Route::post('/livros/{id}/comentario','App\Http\Controllers\LivrosController@comentario')
    ->name('livros.comentario');

//Route Generos

Route::get('/generos','App\Http\Controllers\GenerosController@index')
    ->name('generos.index');

Route::get('/generos/{idg}/show','App\Http\Controllers\GenerosController@show')
    ->name('generos.show');

Route::get('/generos/create','App\Http\Controllers\GenerosController@create')
    ->name('generos.create')->middleware('auth');

Route::post('/generos/store','App\Http\Controllers\GenerosController@store')
    ->name('generos.store')->middleware('auth');

Route::get('/generos/{idg}/edit','App\Http\Controllers\GenerosController@edit')
    ->name('generos.edit')->middleware('auth');

Route::patch('/generos/{idg}/update','App\Http\Controllers\GenerosController@update')
    ->name('generos.update')->middleware('auth');

Route::get('/generos/{idg}/deleted','App\Http\Controllers\GenerosController@deleted')
    ->name('generos.delete')->middleware('auth');

Route::delete('/generos/{idg}/destroy','App\Http\Controllers\GenerosController@destroy')
    ->name('generos.destroy')->middleware('auth');


//Route Editoras

Route::get('/editoras','App\Http\Controllers\EditorasController@index')
    ->name('editoras.index');

Route::get('/editoras/{ide}/show','App\Http\Controllers\EditorasController@show')
    ->name('editoras.show');

Route::get('/editoras/create','App\Http\Controllers\EditorasController@create')
    ->name('editoras.create')->middleware('auth');

Route::post('/editoras/store','App\Http\Controllers\EditorasController@store')
    ->name('editoras.store')->middleware('auth');

Route::get('/editoras/{ide}/edit','App\Http\Controllers\EditorasController@edit')
    ->name('editoras.edit')->middleware('auth');

Route::patch('/editoras/{ide}/update','App\Http\Controllers\EditorasController@update')
    ->name('editoras.update')->middleware('auth');

Route::get('/editoras/{ide}/deleted','App\Http\Controllers\EditorasController@deleted')
    ->name('editoras.delete')->middleware('auth');

Route::delete('/editoras/{ide}/destroy','App\Http\Controllers\EditorasController@destroy')
    ->name('editoras.destroy')->middleware('auth');


//Route Autores

Route::get('/autores','App\Http\Controllers\AutoresController@index')
    ->name('autores.index');

Route::get('/autores/{ida}/show','App\Http\Controllers\AutoresController@show')
    ->name('autores.show');

Route::get('/autores/create','App\Http\Controllers\AutoresController@create')
    ->name('autores.create')->middleware('auth');

Route::post('/autores/store','App\Http\Controllers\AutoresController@store')
    ->name('autores.store')->middleware('auth');

Route::get('/autores/{ida}/edit','App\Http\Controllers\AutoresController@edit')
    ->name('autores.edit')->middleware('auth');

Route::patch('/autores/{ida}/update','App\Http\Controllers\AutoresController@update')
    ->name('autores.update')->middleware('auth');

Route::get('/autores/{ida}/deleted','App\Http\Controllers\AutoresController@deleted')
    ->name('autores.delete')->middleware('auth');

Route::delete('/autores/{ida}/destroy','App\Http\Controllers\AutoresController@destroy')
    ->name('autores.destroy')->middleware('auth');


//Route Edições

Route::get('/edicoes','App\Http\Controllers\EdicoesController@index')
    ->name('edicoes.index');

Route::get('/edicoes/{ided}/show','App\Http\Controllers\EdicoesController@index')
    ->name('edicoes.show');


//Route Formularios

Route::get('/pesquisa','App\Http\Controllers\PesquisaController@index')
    ->name('pesquisa.index');

Route::post('/form','App\Http\Controllers\PesquisaController@formenviado')
    ->name('pesquisa.form');


// Routes login etc...

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
