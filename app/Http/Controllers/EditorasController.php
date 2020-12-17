<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Http\Request;
use App\Models\Editora;

class EditorasController extends Controller
{
    //
    public function index(){
        //$editoras = Editora::all()->sortbydesc('idl');
        $editoras= Editora::paginate(4);
        return view('editoras.index',[
            'editoras'=>$editoras
        ]);
    }



    public function show(Request $request){
        $idEditora = $request->ide;
        //$editora=Editora::findOrFail($idEditora);
        //$editora=Editora::find($idEditora);
        $editora=Editora::where('id_editora',$idEditora)->with('livros')->first();
        return view('editoras.show',[
            'editora'=>$editora
        ]);
    }



    public function create(){
        if(Gate::allows('admin')){
            return view('editoras.create');
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function store(Request $request){
        $novoEditora=$request->validate([
            'nome'=>['required','min:3','max:100'],
            'morada'=>['nullable','min:3','max:255'],
            'observacoes'=>['nullable','min:3','max:255']
        ]);
        if(Gate::allows('admin')){
            $editora=Editora::create($novoEditora);
            return redirect()->route('editoras.show',[
                'ide'=>$editora->id_editora
            ]);
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function edit(Request $request){
        $ide = $request->ide;
        $editora=Editora::where('id_editora',$ide)->with('livros')->first();
        if(Gate::allows('admin')){
            return view('editoras.edit',['editora'=>$editora]);
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function update(Request $request){
        $ide = $request->ide;
        $editora=Editora::where('id_editora',$ide)->with('livros')->first();
        $editEditora=$request->validate([
            'nome'=>['required','min:3','max:100'],
            'morada'=>['nullable','min:3','max:255'],
            'observacoes'=>['nullable','min:3','max:255']
        ]);
        if(Gate::allows('admin')){
            $editarEditora=$editora->update($editEditora);
            return redirect()->route('editoras.show',[
                'ide'=>$editora->id_editora
            ]);
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function deleted(Request $r){
        $ide = $r->ide;
        $editora=Editora::where('id_editora',$ide)->first();
        if(Gate::allows('admin')){
            if(is_null($editora)){
                return redirect()->route('editoras.index')->with('msg','Não existe esta editora');
            }
            else{
                return view('editoras.delete',['editora'=>$editora]);
            }
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }



    public function destroy(Request $r){
        $ide = $r->ide;
        $editora=Editora::where('id_editora',$ide)->first();
        if(Gate::allows('admin')){
            if(is_null($editora)){
                return redirect()->route('editoras.index')->with('msg','Não existe esta editora');
            }
            else{
                $eliminareditora=$editora->delete();
                return redirect()->route('editoras.index');
            }
        }
        else{
            return redirect()->route('editoras.index')
                ->with('msg','Não têm permissão para aceder a area pretendida');
        }
    }
}
