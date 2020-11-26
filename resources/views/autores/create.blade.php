@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Autores
@endsection
@section('conteudo')
<form action="{{route('autores.store')}}" method="post">
    @csrf

Nome: <input type="text" name="nome" value="{{old('nome')}}"><br>
@if($errors->has('nome'))
Deverá ter um Nome correto<br>
@endif

Nacionalidade: <input type="text" name="nacionalidade" value="{{old('nacionalidade')}}"><br>
@if($errors->has('nacionalidade'))
Deverá ter um Nacionalidade correto<br>
@endif

Data Nascimento: <input type="date" name="data_nascimento" value="{{old('data_nascimento')}}"><br>
@if($errors->has('data_nascimento'))
Deverá ter um Data Nascimento correto<br>
@endif

Fotografia: <input type="text" name="fotografia" value="{{old('fotografia')}}"><br>
@if($errors->has('fotografia'))
Deverá ter um Fotografia correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection