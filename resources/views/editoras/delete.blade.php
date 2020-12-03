@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Editoras
@endsection
@section('conteudo')
<form action="{{route('editoras.destroy',['ide'=>$editora->id_editora])}}" method="post">
    @csrf
    @method('delete')

<input type="hidden" value="{{$editora->id_editora}}"><br>
<input type="submit" value="Eliminar Editora">
</form>
@endsection