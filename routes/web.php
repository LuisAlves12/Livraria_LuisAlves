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

//Routes Livros

Route::get('/livros','App\Http\Controllers\LivrosController@index')
    ->name('livros.index');

Route::get('/livros/{id}/show','App\Http\Controllers\LivrosController@show')
    ->name('livros.show');

Route::get('/livros/create','App\Http\Controllers\LivrosController@create')
    ->name('livros.create');

Route::post('/livros/store','App\Http\Controllers\LivrosController@store')
    ->name('livros.store');

Route::get('/livros/{id}/edit','App\Http\Controllers\LivrosController@edit')
    ->name('livros.edit');

Route::patch('/livros/{id}/update','App\Http\Controllers\LivrosController@update')
    ->name('livros.update');

//Route Generos

Route::get('/generos','App\Http\Controllers\GenerosController@index')
    ->name('generos.index');

Route::get('/generos/{idg}/show','App\Http\Controllers\GenerosController@show')
    ->name('generos.show');

Route::get('/generos/create','App\Http\Controllers\GenerosController@create')
    ->name('generos.create');

Route::post('/generos/store','App\Http\Controllers\GenerosController@store')
    ->name('generos.store');

Route::get('/generos/{idg}/edit','App\Http\Controllers\GenerosController@edit')
    ->name('generos.edit');

Route::patch('/generos/{idg}/update','App\Http\Controllers\GenerosController@update')
    ->name('generos.update');


//Route Editoras

Route::get('/editoras','App\Http\Controllers\EditorasController@index')
    ->name('editoras.index');

Route::get('/editoras/{ide}/show','App\Http\Controllers\EditorasController@show')
    ->name('editoras.show');

Route::get('/editoras/create','App\Http\Controllers\EditorasController@create')
    ->name('editoras.create');

Route::post('/editoras/store','App\Http\Controllers\EditorasController@store')
    ->name('editoras.store');

Route::get('/editoras/{ide}/edit','App\Http\Controllers\EditorasController@edit')
    ->name('editoras.edit');

Route::patch('/editoras/{ide}/update','App\Http\Controllers\EditorasController@update')
    ->name('editoras.update');


//Route Autores

Route::get('/autores','App\Http\Controllers\AutoresController@index')
    ->name('autores.index');

Route::get('/autores/{ida}/show','App\Http\Controllers\AutoresController@show')
    ->name('autores.show');

Route::get('/autores/create','App\Http\Controllers\AutoresController@create')
    ->name('autores.create');

Route::post('/autores/store','App\Http\Controllers\AutoresController@store')
    ->name('autores.store');

Route::get('/autores/{ida}/edit','App\Http\Controllers\AutoresController@edit')
    ->name('autores.edit');

Route::patch('/autores/{ida}/update','App\Http\Controllers\AutoresController@update')
    ->name('autores.update');


//Route Edições

Route::get('/edicoes','App\Http\Controllers\EdicoesController@index')
    ->name('edicoes.index');

Route::get('/edicoes/{ided}/show','App\Http\Controllers\EdicoesController@index')
    ->name('edicoes.show');


//Route Formularios

Route::get('/','App\Http\Controllers\PesquisaController@index')
    ->name('pesquisa.index');

Route::post('/form','App\Http\Controllers\PesquisaController@formenviado')
    ->name('pesquisa.form');
