<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CaminhaoController extends Controller
{
    public function FormularioCadastro()
    {
        return view('cadastrarCaminhao');
    }

    public function MostrarEditarCaminhao(Request $request){
        
        $dadosCaminhao = Caminhao::all();
        $dadosCaminhao = caminhao::query();
        $dadosCaminhao->when($request->marca,function($query, $v1){
            $query->where('marca','like','%' .$v1.'%');
        });
        $dadosCaminhao = $dadosCaminhao->get();

        //dd($dadosCaminhao);
        return view('editarCaminhao',[
            'registrosCaminhao' => $dadosCaminhao
        ]);
              
    }  

    
    public function SalvarBanco(Request $request)

    {
        $dadosCaminhao = $request->validate([
            'modelo' => 'string|required',
            'marca' => 'string|required',
            'ano' => 'string|required',
            'cor' => 'string|required',
            'valor' => 'string|required'
        ]);

        Caminhao::create($dadosCaminhao);
        return Redirect::route('home');
    }

    public function ApagarBancoCaminhao(Caminhao $registrosCaminhoes){
        //dd($registrosCaminhoes);
        $registrosCaminhoes->delete();
       //Caminhao::findOrFail($id)->delete();
        return Redirect::route('editar-caminhao');
    }

    public function MostrarAlterarCaminhao(Caminhao $registrosCaminhoes){
        return view('alterarCaminhao', ['registrosCaminhoes' => $registrosCaminhoes]);
    }
    
    public function AlterarBancoCaminhao(Caminhao $registrosCaminhoes, Request $request){
        $banco = $request->validate([
            'modelo' => 'string|required',
            'marca' => 'string|required',
            'ano' => 'string|required',
            'cor' => 'string|required',
            'valor' => 'string|required'
        ]);  
        $registrosCaminhoes-> fill($banco);
        $registrosCaminhoes-> save();

        return Redirect::route('editar-caminhao');

        
        
    }    



}
