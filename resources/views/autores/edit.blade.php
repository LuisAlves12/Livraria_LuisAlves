@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Autores
@endsection
@section('conteudo')
<form action="{{route('autores.update',['ida'=>$autores->id_autor])}}" method="post">
    @method('patch')
    @csrf

Nome: <input type="text" name="nome" value="{{$autores->nome}}"><br>
@if($errors->has('nome'))
Deverá ter um Nome correto<br>
@endif

Nacionalidade: <input type="text" name="nacionalidade" value="{{$autores->nacionalidade}}"><br>
@if($errors->has('nacionalidade'))
Deverá ter um Nacionalidade correto<br>
@endif

Data Nascimento: <input type="date" name="data_nascimento" value="@if(!is_null($autores->data_nascimento){{$autores->data_nascimento->format('Y-m-d')}}@endif><br>
@if($errors->has('data_nascimento'))
Deverá ter um Data Nascimento correto<br>
@endif

Fotografia: <input type="text" name="fotografia" value="{{$autores->fotografia}}"><br>
@if($errors->has('fotografia'))
Deverá ter um Fotografia correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection