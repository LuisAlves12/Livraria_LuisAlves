@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('Titulo')
Editoras
@endsection
@section('conteudo')
<ul>
{{$editoras->render()}}
@foreach($editoras as $editora)
<li>
<a href="{{route('editoras.show', ['ide'=>$editora->id_editora])}}">
    {{$editora->nome}}
</a></li>
@endforeach
</ul>
@if(Gate::allows('admin'))
<a href="{{route('editoras.create')}}" class="btn btn-info" role="button">Adiciona Editoras</a>
@endif
<style>
.wrapper{
  width:100%;
  padding-top: 20px;
  text-align:center;
}
.carousel{
  width:90%;
  margin:0px auto;
}
.slick-slide{
  margin:10px;
}
.slick-slide img{
  width:100%;
  border: 2px solid #fff;
}
</style>



<script type="text/javascript">
$(document).ready(function(){
  $('.carousel').slick({
  slidesToShow: 3,
  centerMode: true,
  });
});
</script>



<div class="wrapper">
<div class="carousel">
  <div><img src="{{asset('imagens/Livraria-Lello-1.jpg')}}"></div>
  <div><img src="{{asset('imagens/umaaventura.jpg')}}"></div>
  <div><img src="{{asset('imagens/umaaventura1.jpg')}}"></div>
  <div><img src="{{asset('imagens/umaaventura2.jpg')}}"></div>
  <div><img src="{{asset('imagens/umaaventura5.jpg')}}"></div>
</div>
</div>
@endsection