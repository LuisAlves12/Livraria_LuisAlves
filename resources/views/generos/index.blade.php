@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Generos
@endsection
@section('conteudo')
<ul>
{{$generos->render()}}
@foreach($generos as $genero)
<li>
<a href="{{route('generos.show', ['idg'=>$genero->id_genero])}}">
    {{$genero->designacao}}
</a></li>
@endforeach
</ul>
<a href="{{route('generos.create')}}" class="btn btn-info" role="button">Adiciona Generos</a>
@endsection