<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CarroController extends Controller
{
    public function FormularioCadastroCarro()
    {
        return view('CadastrarCarro');
    }

    public function MostrarEditarCarro(){
    
        $dadosCarro = Carro::all();
        //dd($dadosCarro);
        return view('editarCarro',[
         'registroCarro' => $dadosCarro 
        ]);      
        
    
}


    public function SalvarBancoCarro(Request $request)

    {
        $dadosCarro = $request->validate([
            'modelo' => 'string|required',
            'marca' => 'string|required',
            'ano' => 'string|required',
            'cor' => 'string|required',
            'valor' => 'string|required'
        ]);

        Carro::create($dadosCarro);
        return Redirect::route('home');
    }

    public function ApagarBancoCarro(Carro $registrosCarros){
        //dd($registrosCarro);
        $registrosCarros->delete();
       //Carro::findOrFail($id)->delete();
        return Redirect::route('editar-carro');
    }
}
