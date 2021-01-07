@extends('layout')
@section('titulo-pagina')
Livraria 
@endsection
@section('Titulo')
Livro: 
@endsection
@section('conteudo')
<ul>
ID:{{$livro->id_livro}}<br>
Titulo:{{$livro->titulo}}<br>
Idioma:{{$livro->idioma}} <i class="{{strtolower($livro->idioma)}} flag"> </i><br>
ISBN:{{$livro->isbn}}<br>

@if(!is_null($livro->data_edicao))
Data Edição:{{$livro->data_edicao->format('d-m-Y')}}<br>
@endif

Total paginas:{{$livro->total_paginas}}<br>
Observações:{{$livro->observacoes}}<br>
Imagem Capa: @if(isset($livro->imagem_capa ))<img src="{{asset('imagens/livros/'.$livro->imagem_capa)}}" style="width:10%">@endif<br>
Ficheiro livro: @if(isset($livro->ficheiro_livro))<a href="{{asset('imagens/ficheiros/'.$livro->ficheiro_livro)}}" target="_blank">PDF</a>@endif<br>

@if(count($livro->editoras)>0)
        @foreach($livro->editoras as $editora)
        Nome Editora:{{$editora->nome}}<br>
        @endforeach
    @else
        <diV class="alert alert-danger" role="alert">
        Sem o nome do editora definido
        </div>
    @endif

    @if(isset ($livro->genero->designacao))
        Genero:{{$livro->genero->designacao}}<br>
    @else
        <diV class="alert alert-danger" role="alert">
        Sem género definido
        </div>
    @endif
    
    @if(count($livro->autores)>0)
        @foreach($livro->autores as $autor)
            Autor:{{$autor->nome}}<br>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
        Sem o nome do autor definido
        </div>
    @endif

    @if(isset ($livro->users->name))
    Nome do Utilizador:{{$livro->users->name}}<br>
    @else
        <div class="alert alert-danger" role="alert">
        Sem utilizador definido
        </div>
    @endif


Sinopse:{{$livro->sinopse}}<br>
Created_at:{{$livro->created_at}}<br>
Updated_at:{{$livro->updated_at}}<br>
Deleted_at:{{$livro->deleted_at}}<br><br>

Numero de Likes: {{$likes}}
@if($utilizador!=null)
<i class="fas fa-thumbs-up" style=" color:red"></i>
@else
<a href="{{route('livros.likes',['id'=>$livro->id_livro])}}">
<i class="fas fa-thumbs-up"></i>
</a>
@endif
<br><br>
Comentario:
<form action="">
<textarea name="comentario"></textarea>
</form>

</ul>
@if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin'))
    <a href="{{route('livros.edit',['id'=>$livro->id_livro])}}" class="btn btn-info" role="button">Editar Livro</a>
    <a href="{{route('livros.deleted',['id'=>$livro->id_livro])}}" class="btn btn-info" role="button">Eliminar Livro</a>
@endif
@endsection