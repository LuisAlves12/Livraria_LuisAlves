@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Livros
@endsection
@section('conteudo')
<form action="{{route('livros.store')}}" method="post">
    @csrf
Titulo: <input type="text" name="titulo"><br>
Idioma: <input type="text" name="idioma"><br>
Total Paginas: <input type="text" name="total_paginas"><br>
Data Edição: <input type="text" name="data_edicao"><br>
ISBN: <input type="text" name="isbn"><br>
Observações: <textarea  name="observacoes"></textarea><br>
Imagem Capa: <input type="text" name="imagem_capa"><br>
Género: <input type="text" name="id_genero"><br>
Autor: <input type="text" name="id_autor"><br>
Sinopse: <textarea name="sinopse"></textarea><br><br>
<input type="submit" value="enviar">
</form>
@endsection