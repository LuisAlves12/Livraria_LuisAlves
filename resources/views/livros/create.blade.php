@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Livros
@endsection
@section('conteudo')
<form action="{{route('livros.store')}}" enctype="multipart/form-data" method="post">
    @csrf

Titulo: <input type="text" name="titulo" value="{{old('titulo')}}"><br>
@if($errors->has('titulo'))
Deverá ter um titulo correto<br>
@endif

Idioma: <input type="text" name="idioma" value="{{old('idioma')}}"><br>
@if($errors->has('idioma'))
Deverá ter um idioma correto<br>
@endif

Total Paginas: <input type="text" name="total_paginas" value="{{old('total_paginas')}}"><br>
@if($errors->has('total_paginas'))
Deverá ter um Total Paginas correto<br>
@endif

Data Edição: <input type="date" name="data_edicao" value="{{old('data_edicao')}}"><br>
@if($errors->has('data_edicao'))
Deverá ter um Data Edição correto<br>
@endif

ISBN: <input type="text" name="isbn" value="{{old('isbn')}}"><br>
@if($errors->has('isbn'))
Deverá ter um ISBN correto <br>
@endif

Observações: <textarea  name="observacoes" value="{{old('observacoes')}}"></textarea><br>
@if($errors->has('observacoes'))
Deverá ter um Observações correto<br>
@endif

Imagem Capa:  <input type="file" name="imagem_capa" value=" {{old('imagem_capa')}}"><br>
@if($errors->has('imagem_capa'))
Deverá ter um Imagem Capa correto<br>
@endif

Genero: <select name="id_genero">
    @foreach($genero as $generos)
        <option value="{{$generos->id_genero}}">{{$generos->designacao}}</option>
    @endforeach
</select><br>
@if($errors->has('id_genero'))
Deverá ter um Género correto <br>
@endif

Autor(es): <select name="id_autor[]"multiple="multiple">
    @foreach($autores as $autor)
        <option value="{{$autor->id_autor}}">{{$autor->nome}}</option><br>
    @endforeach
</select><br>
@if($errors->has('id_autor'))
Deverá ter um Autor correto <br>
@endif

Nome Editora: <select name="id_editora[]" multiple="multiple">
        @foreach($editoras as $editora)
            <option value="{{$editora->id_editora}}">{{$editora->nome}}</option>
        @endforeach
    </select><br>
@if($errors->has('id_editora'))
Deverá ter uma Editora correto <br>
@endif//

Sinopse: <textarea name="sinopse" value="{{old('sinopse')}}"></textarea><br><br>
@if($errors->has('sinopse'))
Deverá ter um Sinopse correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection