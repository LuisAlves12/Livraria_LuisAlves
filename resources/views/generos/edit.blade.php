@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Generos
@endsection
@section('conteudo')
<form action="{{route('generos.update',['idg'=>$genero->id_genero])}}" method="post">
    @method('patch')
    @csrf

Designação: <input type="text" name="designacao" value="{{$genero->designacao}}"><br>
@if($errors->has('designacao'))
Deverá ter um Designação correto<br>
@endif

Observações: <input type="text" name="observacoes" value="{{$genero->observacoes}}"><br>
@if($errors->has('observacoes'))
Deverá ter um Observações correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection