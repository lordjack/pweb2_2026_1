<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    function index(Curso $curso)
    {
        $dados = $curso->turmas; //select * from turma where curso_id = $curso->id

        return view('turma.list', [
            'dados' => $dados,
            'curso' => $curso
        ]);
    }

    function create(Curso $curso)
    {
        return view('turma.form', ['curso', $curso]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ], [
            'nome.required' => "O :attribute é obrigatório",
        ]);
    }

    function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $turma = Turma::create($data);

        return redirect()->route('curso.turmas', $turma->curso_id);
    }

    function edit($id)
    {
        $dado = Turma::find($id);

        return view('turma.form', [
            'dado' => $dado,
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $turma = Turma::find($id)->update($data);

        return redirect()->route('curso.turmas', $turma->curso_id);
    }

    function destroy($id)
    {
        $dado = Turma::findOrfail($id);

        $dado->delete();

        return redirect()->route('curso.turmas', $dado->curso_id);
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Turma::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = Turma::all();
        }

        return view('turma.list', ['dados' => $dados]);
    }
}
