<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;

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
        $autores=Autor::all();
        $genero=Genero::all();
        $editoras=Editora::all();
        return view('livros.create',[
            'genero'=>$genero,
            'autores'=>$autores,
            'editoras'=>$editoras,
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
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        $autores=$request->id_autor;
        $editora=$request->id_editora;
        $livro=Livro::create($novoLivro);
        $livro->autores()->attach($autores);
        $livro->editoras()->attach($editora);
        return redirect()->route('livros.show',[
            'id'=>$livro->id_livro
        ]);
    }
    public function edit(Request $request){
        $id = $request->id;
        $autores=Autor::all();
        $genero=Genero::all();
        $editoras=Editora::all();
        $livro=Livro::where('id_livro',$id)->with(['genero','autores','editoras'])->first();
        $autoresLivro=[];
        foreach($livro->autores as $autor){
            $autoresLivro[]=$autor->id_autor;
        }
        $editorasLivro= [];
        foreach($livro->editoras as $editora){
            $editorasLivro[]=$editora->id_editora;
        }
        return view('livros.edit',[
            'livro'=>$livro,
            'genero'=>$genero,
            'autores'=>$autores,
            'editoras'=>$editoras,
            'autoresLivro'=>$autoresLivro,
            'editorasLivro'=>$editorasLivro
        ]);
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
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        $autores=$request->id_autor;
        $editora=$request->id_editora;
        $editarlivro=$livro->update($editLivro);
        $livro->autores()->sync($autores);
        $livro->editoras()->sync($editora);
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
    public function destroy(Request $request){
        $livro= Livro::where('id_livro', $request->id)->first();
        
        $autoresLivro=Livro::findOrfail($request->id)->autores;
        $editorasLivro=Livro::findOrfail($request->id)->editoras;
        $livro->autores()->detach($autoresLivro);
        $livro->editoras()->detach($editorasLivro);

        if(is_null($livro)){

            return redirect()->route('livros.index')->with('msg','O livro não existe');
        }
        else{

            $livro->delete();
            return redirect()->route('livros.index');
        }

    }
}
