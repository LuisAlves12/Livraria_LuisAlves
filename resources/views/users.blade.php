@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Utilizadores: 
@endsection
@section('conteudo')

@if(Gate::allows('admin'))
    <br>
  <table class="table table-dark table-striped">
  @foreach($users as $user)
    <tr>
    <td>ID: {{$user->id}} </td>
    <td>Nome: {{$user->name}} </td>
    <td>Email: {{$user->email}} </td>
    <td>Tipo do utilizador: {{$user->tipo_user}} </td>
    </tr>
  @endforeach
  </tr>
  </table>
@endif
<br><br>
@endsection