@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Editoras
@endsection
@section('conteudo')
<form action="{{route('editoras.store')}}" method="post">
    @csrf

Nome: <input type="text" name="nome" value="{{old('nome')}}"><br>
@if($errors->has('nome'))
Deverá ter um Nome correto<br>
@endif

Morada: <input type="text" name="morada" value="{{old('morada')}}"><br>
@if($errors->has('morada'))
Deverá ter um Morada correto<br>
@endif

Observações: <input type="text" name="observacoes" value="{{old('observacoes')}}"><br>
@if($errors->has('observacoes'))
Deverá ter um Observações correto<br>
@endif

<input type="submit" value="enviar">
</form>
@endsection