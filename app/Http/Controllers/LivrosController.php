<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;
use App\Models\User;
use App\Models\Like;


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
        $utilizador="";
        //$livro=Livro::findOrFail($idLivro);
        //$livro=Livro::find($idLivro);
        $likes=Like::where('id_livro',$idLivro)->count();
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras','users'])->first();
        if(Auth::check()){
            $idUtilizador= Auth::user()->id;
            $utilizador=Like::where('id_user',$idUtilizador)->where('id_livro',$idLivro)->first();
        }
        return view('livros.show',[
            'livro'=>$livro,
            'likes'=>$likes,
            'utilizador'=>$utilizador
        ]);
    }


    public function create(){
        if(Auth::check()){
            $autores=Autor::all();
            $genero=Genero::all();
            $editoras=Editora::all();
            return view('livros.create',[
                'genero'=>$genero,
                'autores'=>$autores,
                'editoras'=>$editoras,
            ]);
        }
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        } 
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
            'imagem_capa'=>['image','nullable','max:2000'],
            'ficheiro_livro'=>['file','mimes:pdf,doc,docx','max:2000'],
            'id_genero'=>['nullable','numeric','min:1'],
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        if($request->hasfile('imagem_capa')){
            $nomeImagem=$request->file('imagem_capa')->getClientOriginalName();
            $nomeImagem=time().'_'.$nomeImagem;
            $guardarImagem=$request->file('imagem_capa')->storeAs('imagens/livros',$nomeImagem);
            $novoLivro['imagem_capa']=$nomeImagem;
        }
        if($request->hasfile('ficheiro_livro')){
            $nomeFicheiro=$request->file('ficheiro_livro')->getClientOriginalName();
            $nomeFicheiro=time().'_'.$nomeFicheiro;
            $guardarFicheiro=$request->file('ficheiro_livro')->storeAs('imagens/ficheiros',$nomeFicheiro);
            $novoLivro['ficheiro_livro']=$nomeFicheiro;
        }
        if(Gate::allows('admin')){
            if(Auth::check()){
                $userAtual=Auth::user()->id;
                $novoLivro['id_user']=$userAtual;
            }
            else{
                return redirect()->route('livros.index')->with('msg','Não está logado');
            }
            $autores=$request->id_autor;
            $editora=$request->id_editora;
            $livro=Livro::create($novoLivro);
            $livro->autores()->attach($autores);
            $livro->editoras()->attach($editora);
            return redirect()->route('livros.show',[
                'id'=>$livro->id_livro
            ]);
        }
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        } 
    }


    public function edit(Request $request){
        $id = $request->id;
        $livro=Livro::where('id_livro',$id)->with(['genero','autores','editoras','users'])->first();
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
            $autores=Autor::all();
            $genero=Genero::all();
            $editoras=Editora::all();
            $autoresLivro=[];
            foreach($livro->autores as $autor){
                $autoresLivro[]=$autor->id_autor;
            }
            $editorasLivro= [];
            foreach($livro->editoras as $editora){
                $editorasLivro[]=$editora->id_editora;
            }
            if(isset($livro->users->id_user)){
                if(Auth::user()->id == $livro->users->id_user){
                    return view('livros.edit',[
                        'livro'=>$livro,
                        'genero'=>$genero,
                        'autores'=>$autores,
                        'editoras'=>$editoras,
                        'autoresLivro'=>$autoresLivro,
                        'editorasLivro'=>$editorasLivro
                    ]);
                }
                else{
                    return redirect()->route('livros.show',[
                    'id'=>$id]);
                }
            }
            else{
                return view('livros.edit',[
                    'livro'=>$livro,
                    'genero'=>$genero,
                    'autores'=>$autores,
                    'editoras'=>$editoras,
                    'autoresLivro'=>$autoresLivro,
                    'editorasLivro'=>$editorasLivro
                ]);
            }
        }
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');

        } 
    }


    public function update(Request $request){
        $id = $request->id;
        $livro=Livro::where('id_livro',$id)->with(['genero','autores','editoras','users'])->first();
        $imagemAntiga=$livro->imagem_capa;
        $ficheiroAntigo=$livro->ficheiro_livro;
        $editLivro=$request->validate([
            'titulo'=>['required','min:3','max:100'],
            'idioma'=>['required','min:3','max:10'],
            'total_paginas'=>['nullable','numeric','min:1'],
            'data_edicao'=>['nullable','date'],
            'isbn'=>['nullable','min:13','max:13'],
            'observacoes'=>['nullable','min:3','max:255'],
            'imagem_capa'=>['image','nullable','max:2000'],
            'ficheiro_livro'=>['file','mimes:pdf,doc,docx','max:2000'],
            'id_genero'=>['nullable','numeric'],
            'sinopse'=>['nullable','min:3','max:255']
        ]);
        if($request->hasfile('imagem_capa')){
            $nomeImagem=$request->file('imagem_capa')->getClientOriginalName();
            $nomeImagem=time().'_'.$nomeImagem;
            $guardarImagem=$request->file('imagem_capa')->storeAs('imagens/livros',$nomeImagem);
            if(!is_null($imagemAntiga)){
                Storage::Delete('imagens/livros/'.$imagemAntiga);
            }
            $editLivro['imagem_capa']=$nomeImagem;
        }
        if($request->hasfile('ficheiro_livro')){
            $nomeFicheiro=$request->file('ficheiro_livro')->getClientOriginalName();
            $nomeFicheiro=time().'_'.$nomeFicheiro;
            $guardarFicheiro=$request->file('ficheiro_livro')->storeAs('imagens/ficheiros',$nomeFicheiro);
            if(!is_null($ficheiroAntigo)){
                Storage::Delete('imagens/ficheiros/'.$ficheiroAntigo);
            }
            $editLivro['ficheiro_livro']=$nomeFicheiro;
        }
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
            $autores=$request->id_autor;
            $editora=$request->id_editora;
            $editarlivro=$livro->update($editLivro);
            $livro->autores()->sync($autores);
            $livro->editoras()->sync($editora);
            return redirect()->route('livros.show',[
                'id'=>$livro->id_livro
            ]);
        }
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');

        } 
    }


    public function deleted(Request $r){
        $id = $r->id;
        $livro=Livro::where('id_livro',$id)->first();
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
            if(isset($livro->users->id_user)){
                if(Auth::user()->id == $livro->users->id_user){
                    if(is_null($livro)){
                        return redirect()->route('livros.index')->with('msg','Não existe este livro');
                    }
                    else{
                        return view('livros.delete',['livro'=>$livro]);
                    }
                }
                else{
                    return redirect()->route('livros.show',[
                        'id'=>$id]);
                }
            }
            else{
                if(is_null($livro)){
                    return redirect()->route('livros.index')->with('msg','Não existe este livro');
                }
                else{
                    return view('livros.delete',['livro'=>$livro]);
                }
            }
        }
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');

        } 
    }


    public function destroy(Request $request){
        $livro= Livro::where('id_livro', $request->id)->first();
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
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
        else{
            return redirect()->route('livros.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }


    public function likes(Request $request){
        $id=$request->id;
        if(Auth()->check()){
            $idUtilizador= Auth::user()->id; 
            $like=Like::where('id_user',$idUtilizador)->where('id_livro',$id)->first();
            if($like==null){
                $novoLike['id_livro']=$id;
                $novoLike['id_user']=$idUtilizador;
                $like=Like::create($novoLike);
                return redirect()->route('livros.show',['id'=>$id]);
            }
            else{
                return redirect()->route('livros.show',['id'=>$id])->with('mensagem','');
            }
        }
        else{
            return redirect()->route('livros.show',['id'=>$id])->with('msg','Não esta logado');
        }
    }
}
