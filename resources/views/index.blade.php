@extends('layout')
@section('titulo-pagina')
Livraria 
@endsection
@section('conteudo')
<style>
.container{width:95%;max-width:970px;margin:auto;color:#fff}
body{}
.text-center{text-align:center}
.social_icons a {
  color: #F2FFFF;
  font-size: 29px;
  margin-right: 45px;
  background-color:#1abc9c;
  padding: 15px;
  border-radius: 29px;
  height: 29px;
  width: 29px;
}

.name{}
.name h2 {
  font-family: 'Ubuntu', sans-serif;
  font-size: 80px;
  margin-top: 150px;
}
</style>



<script type="text/javascript">
$('body').vegas({
  overlay: true,
  transition: 'fade', 
  transitionDuration: 4000,
  delay: 10000,
  animation: 'random',
  animationDuration: 20000,
  slides: [
    { src: "{{asset('imagens/Livraria-Lello-1.jpg')}}" }  
  ]
});
</script>

<div class="container">
    <div class="name text-center">
        <h2 style="text-align:center">Livraria</h2> 
    </div>
</div>

<script src="https://raw.githubusercontent.com/jaysalvat/vegas/master/dist/vegas.min.js"></script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
