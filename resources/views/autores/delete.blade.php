@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Autores
@endsection
@section('conteudo')
<form action="{{route('autores.destroy',['ida'=>$autores->id_autor])}}" method="post">
    @csrf
    @method('delete')

<input type="hidden" value="{{$autores->id_autor}}"><br>
<input type="submit" value="Eliminar Autor">
</form>
@endsection