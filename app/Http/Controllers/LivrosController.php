<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Genero;

class LivrosController extends Controller
{
    //
    public function index(){
        //$livros = Livro::all()->sortbydesc('idl');
        $livros= Livro::paginate(4);
        return view('livros.index',[
            'livros'=>$livros
        ]);
    }
    public function show(Request $request){
        $idLivro = $request->id;
        //$livro=Livro::findOrFail($idLivro);
        //$livro=Livro::find($idLivro);
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);
    }
    public function create(){
        $genero=Genero::all();
        return view('livros.create',[
            'genero'=>$genero
        ]);
    }
    public function store(Request $request){
        //$novoLivro=$request->all();
        $novoLivro=$request->validate([
            'titulo'=>['required','min:3','max:100'],
            'idioma'=>['required','min:3','max:10'],
            'total_paginas'=>['nullable','numeric','min:1'],
            'data_edicao'=>['nullable','date'],
            'isbn'=>['nullable','min:13','max:13'],
            'observacoes'=>['nullable','min:3','max:255'],
            'imagem_capa'=>['nullable','min:3','max:255'],
            'id_genero'=>['nullable','numeric','min:1'],
            'id_autor'=>['nullable','numeric','min:1'],
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        $livro=Livro::create($novoLivro);
        return redirect()->route('livros.show',[
            'id'=>$livro->id_livro
        ]);
    }
    public function edit(Request $request){
        $id = $request->id;
        $genero=Genero::all();
        $livro=Livro::where('id_livro',$id)->with(['genero','autores','editoras'])->first();
        return view('livros.edit',['livro'=>$livro,'genero'=>$genero]);
    }
    public function update(Request $request){
        $id = $request->id;
        $livro=Livro::where('id_livro',$id)->with(['genero','autores','editoras'])->first();
        $editLivro=$request->validate([
            'titulo'=>['required','min:3','max:100'],
            'idioma'=>['required','min:3','max:10'],
            'total_paginas'=>['nullable','numeric','min:1'],
            'data_edicao'=>['nullable','date'],
            'isbn'=>['nullable','min:13','max:13'],
            'observacoes'=>['nullable','min:3','max:255'],
            'imagem_capa'=>['nullable','min:3','max:255'],
            'id_genero'=>['nullable','numeric'],
            'id_autor'=>['nullable','numeric','min:1'],
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        $editarlivro=$livro->update($editLivro);
        return redirect()->route('livros.show',[
            'id'=>$livro->id_livro
        ]);
    }
    public function deleted(Request $r){
        $id = $r->id;
        $livro=Livro::where('id_livro',$id)->first();
        if(is_null($livro)){
            return redirect()->route('livros.index')->with('msg','Não existe este livro');
        }
        else{
            return view('livros.delete',['livro'=>$livro]);
        }
    }
    public function destroy(Request $r){
        $id = $r->id;
        $livro=Livro::where('id_livro',$id)->first();
        if(is_null($livro)){
            return redirect()->route('livros.index')->with('msg','Não existe este livro');
        }
        else{
            $eliminarlivro=$livro->delete();
            return redirect()->route('livros.index');
        }
    }
}
