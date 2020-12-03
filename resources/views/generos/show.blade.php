@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Genero
@endsection
@section('conteudo')
<ul>
IDG:{{$genero->id_genero}}<br>
Designacao:{{$genero->designacao}}<br>
Observações:{{$genero->observacoes}}<br>
    @if(count($genero->livros))
        @foreach($genero->livros as $livro)
            {{$livro->titulo}}<br>
        @endforeach
    @else  
        <div class="alert alert-danger" role="alert">
            Neste genero ainda não há livros!
        </div>
    @endif
Created_at:{{$genero->created_at}}<br>
Updated_at:{{$genero->updated_at}}<br>
Deleted_at:{{$genero->deleted_at}}
</ul>
<a href="{{route('generos.edit', ['idg'=>$genero->id_genero])}}" class="btn btn-info" role="button">Editar Genero</a>
<a href="{{route('generos.delete', ['idg'=>$genero->id_genero])}}" class="btn btn-info" role="button">Eliminar Genero</a>
@endsection