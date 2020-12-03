@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Generos
@endsection
@section('conteudo')
<form action="{{route('generos.destroy',['idg'=>$genero->id_genero])}}" method="post">
    @csrf
    @method('delete')

<input type="hidden" value="{{$genero->id_genero}}"><br>
<input type="submit" value="Eliminar Genero">
</form>
@endsection