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
<a href="{{route('editoras.create')}}" class="btn btn-info" role="button">Adiciona Editoras</a>
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
  <div><img src="http://lorempixel.com/200/200/fashion/"></div>
  <div><img src="http://lorempixel.com/200/200/sports/"></div>
  <div><img src="http://lorempixel.com/200/200/animal/"></div>
  <div><img src="http://lorempixel.com/200/200/abstract/"></div>
  <div><img src="http://lorempixel.com/200/200/people/"></div>
</div>
</div>
@endsection