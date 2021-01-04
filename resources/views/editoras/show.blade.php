@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Editora
@endsection
@section('conteudo')
<ul>
IDE:{{$editora->id_editora}}<br>
Nome:{{$editora->nome}}<br>
Morada:{{$editora->morada}}<br>
Observacoes:{{$editora->observacoes}}<br>

@if(count($editora->livros))
        @foreach($editora->livros as $livro)
            {{$livro->titulo}}<br>
        @endforeach
@else  
    <div class="alert alert-danger" role="alert">
        Nesta editora ainda não há livros!
    </div>
@endif

Created_at:{{$editora->created_at}}<br>
Updated_at:{{$editora->updated_at}}<br>
Deleted_at:{{$editora->deleted_at}}
</ul>
@if(Gate::allows('admin'))
<a href="{{route('editoras.edit', ['ide'=>$editora->id_editora])}}" class="btn btn-info" role="button">Editar Editora</a>
<a href="{{route('editoras.delete', ['ide'=>$editora->id_editora])}}" class="btn btn-info" role="button">Eliminar Editora</a>
@endif
@endsection