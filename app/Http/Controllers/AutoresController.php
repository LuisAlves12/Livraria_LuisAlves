<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\User;
use App\Models\Like;

class AutoresController extends Controller
{
    //
    public function index(){
        //$autores = Autor::all()->sortbydesc('idl');
        $autores= Autor::paginate(4);
        return view('autores.index',[
            'autores'=>$autores
        ]);
    }



    public function show(Request $request){
        $idAutores = $request->ida;
        //$autores=Autor::findOrFail($idAutores);
        //$autores=Autor::find($idAutores);
        $autores=Autor::where('id_autor',$idAutores)->with('livros')->first();
        return view('autores.show',[
            'autores'=>$autores
        ]);
    }



    public function create(){
        if(Gate::allows('admin')){
            return view('autores.create');
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function store(Request $request){
        $novoAutor=$request->validate([
            'nome'=>['required','min:3','max:100'],
            'nacionalidade'=>['nullable','min:3','max:20'],
            'data_nascimento'=>['nullable','date'],
            'fotografia'=>['nullable','min:3','max:255'],
        ]);
        if(Gate::allows('admin')){
            $autor=Autor::create($novoAutor);
            return redirect()->route('autores.show',[
                'ida'=>$autor->id_autor
            ]);
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }




    public function edit(Request $request){
        $ida = $request->ida;
        $autores=Autor::where('id_autor',$ida)->with('livros')->first();
        if(Gate::allows('admin')){
            return view('autores.edit',['autores'=>$autores]);
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function update(Request $request){
        $ida = $request->ida;
        $autores=Autor::where('id_autor',$ida)->with('livros')->first();
        $editAutor=$request->validate([
            'nome'=>['required','min:3','max:100'],
            'nacionalidade'=>['nullable','min:3','max:20'],
            'data_nascimento'=>['nullable','date'],
            'fotografia'=>['nullable','min:3','max:255'],
        ]);
        if(Gate::allows('admin')){
            $editarautor=$autores->update($editAutor);
            return redirect()->route('autores.show',[
                'ida'=>$autores->id_autor
            ]);
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }




    public function deleted(Request $r){
        $ida = $r->ida;
        $autores=Autor::where('id_autor',$ida)->first();
        if(Gate::allows('admin')){
            if(is_null($autores)){
                return redirect()->route('autores.index')->with('msg','Não existe este autor');
            }
            else{
                return view('autores.delete',['autores'=>$autores]);
            }
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function destroy(Request $r){
        $ida = $r->ida;
        $autores=Autor::where('id_autor',$ida)->first();
        if(Gate::allows('admin')){
            if(is_null($autores)){
                return redirect()->route('autores.index')->with('msg','Não existe este autor');
            }
            else{
                $eliminarautores=$autores->delete();
                return redirect()->route('autores.index');
            }
        }
        else{
            return redirect()->route('autores.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }
}
