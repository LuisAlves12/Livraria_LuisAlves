@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Editoras
@endsection
@section('conteudo')
<form action="{{route('editoras.update',['ide'=>$editora->id_editora])}}" method="post">
    @method('patch')
    @csrf

Nome: <input type="text" name="nome" value="{{$editora->nome}}"><br>
@if($errors->has('nome'))
Deverá ter um Nome correto<br>
@endif

Morada: <input type="text" name="morada" value="{{$editora->morada}}"><br>
@if($errors->has('morada'))
Deverá ter um Morada correto<br>
@endif

Observações: <input type="text" name="observacoes" value="{{$editora->observacoes}}"><br>
@if($errors->has('observacoes'))
Deverá ter um Observações correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection