@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Livros
@endsection
@section('conteudo')
<form action="{{route('livros.destroy',['id'=>$livro->id_livro])}}" method="post">
    @csrf
    @method('delete')

<input type="hidden" value="{{$livro->id_livro}}"><br>
<input type="submit" value="Eliminar Livro">
</form>
@endsection