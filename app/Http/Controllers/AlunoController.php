<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{

    function index()
    {
        $dados = Aluno::all(); //select * from aluno

        // dd($dados);
        //var_dump($dados);
        //  exit;

        return view('aluno.list', ['dados' => $dados]);
    }

    function create()
    {
        return view('aluno.form');
    }

    function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
        ], [
            'nome' => "O :attribute é obrigatório",
            'cpf' => "O :attribute é obrigatório",
        ]);

        //dd($request->all());
        /*
        Aluno::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone
        ]);
        */
        Aluno::create($request->all());

        return redirect('aluno');
    }
}
