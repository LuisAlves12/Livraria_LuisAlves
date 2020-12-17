<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Http\Request;
use App\Models\Genero;

class GenerosController extends Controller
{
    //
    public function index(){
        //$generos = Genero::all()->sortbydesc('idl');
        $generos= Genero::paginate(4);
        return view('generos.index',[
            'generos'=>$generos
        ]);
    }
    public function show(Request $request){
        $idgenero = $request->idg;
        //$genero=Genero::findOrFail($idgenero);
        //$genero=Genero::find($idgenero);
        $genero=Genero::where('id_genero',$idgenero)->with('livros')->first();
        return view('generos.show',[
            'genero'=>$genero
        ]);
    }



    public function create(){
        if(Gate::allows('admin')){
            return view('generos.create');
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function store(Request $request){
        $novoGenero=$request->validate([
            'designacao'=>['required','min:3','max:30'],
            'observacoes'=>['nullable','min:3','max:255']
        ]);
        if(Gate::allows('admin')){
            $genero=Genero::create($novoGenero);
            return redirect()->route('generos.show',[
                'idg'=>$genero->id_genero
            ]);
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function edit(Request $request){
        $idg = $request->idg;
        $genero=Genero::where('id_genero',$idg)->with('livros')->first();
        if(Gate::allows('admin')){
            return view('generos.edit',['genero'=>$genero]);
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function update(Request $request){
        $idg = $request->idg;
        $genero=Genero::where('id_genero',$idg)->with('livros')->first();
        $editGenero=$request->validate([
            'designacao'=>['required','min:3','max:30'],
            'observacoes'=>['nullable','min:3','max:255']
        ]);
        if(Gate::allows('admin')){
            $editargenero=$genero->update($editGenero);
            return redirect()->route('generos.show',[
                'idg'=>$genero->id_genero
            ]);
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function deleted(Request $r){
        $idg = $r->idg;
        $genero=Genero::where('id_genero',$idg)->first();
        if(Gate::allows('admin')){
            if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg','Não existe este genero');
            }
            else{
                return view('generos.delete',['genero'=>$genero]);
            }
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function destroy(Request $r){
        $idg = $r->idg;
        $genero=Genero::where('id_genero',$idg)->first();
        if(Gate::allows('admin')){
            if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg','Não existe este geenero');
            }
            else{
                $eliminargenero=$genero->delete();
                return redirect()->route('generos.index');
            }
        }
        else{
            return redirect()->route('generos.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }
}
