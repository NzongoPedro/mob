<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Alunos::paginate(30);

        return Inertia::render('alunos', ['dados' => $dados]);
    }

    public function getAll()
    {
        $alunos = Alunos::orderBy('aluno_nome', 'asc')->get();


        return response()->json(['alunos' => $alunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*    $enviar = Alunos::create([
            'aluno_code' => 122,
            'aluno_nome' => 'Hetione Figueira',
            'aluno_bi' => '0001235HB011',
            'aluno_data_nascimento' => '2002-12-12',
            'aluno_genero' => 'Masculino',
            'aluno_naturalidae' => 'Luanda',
            'aluno_provicia' => 'Uíge',
            'aluno_morada' => 'Camama',
            'aluno_nome_pai' => 'Kiako',
            'aluno_nome_mae' => 'Kiaka',
            'id_classe' => 1,
            'id_turma' => 1,
            'id_sala' => 2,
            'id_ano_letivo' => 2,
            'id_funcionario' => 1,
        ]); */

        //   return redirect('/alunos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados de registro
        $validator = Validator::make($request->all(), [
            'nome' => [
                'required',
                'min:7',
                'regex:/^[\pL\s\-]+$/u',
                'regex:/^(?=.*[aeiou])(?=.*[A-Z]).{2,}$/u'
            ],
            'bi' => [
                'required',
                'unique:alunos,aluno_doc_num',
            ],
            'nome_do_pai' => [
                'required',
                'min:7',
                'regex:/^[\pL\s\-]+$/u',
                'regex:/^(?=.*[aeiou])(?=.*[A-Z]).{2,}$/u'
            ],
            'nome_da_mae' => [
                'required',
                'min:7',
                'regex:/^[\pL\s\-]+$/u',
                'regex:/^(?=.*[aeiou])(?=.*[A-Z]).{2,}$/u'
            ],
            'naturalidade' => [
                'required',
                'min:2',
                'regex:/^[\pL\s\-]+$/u',
                'regex:/^(?=.*[aeiou])(?=.*[A-Z]).{2,}$/u'
            ],
            'morada' => ['required'],


            /* 'email' => 'required|email|unique:users',
            'password' => 'required|min:6', */
        ], [
            'nome_da_mae.required' => 'O nome da mãe é obrigatório.',
            'nome_do_pai.required' => 'O nome do pai é obrigatório.',
            'nome.required' => 'O nome é obrigatório.',
            'naturalidade.required' => 'A naturalidade é obrigatório.',
            'nome.regex' => 'O nome deve conter apenas letras, espaços e hífens.',
            'nome.regex' => 'O nome deve conter pelo menos duas vogais e uma letra maiúscula.',
            'nome.min' => 'O nome deve conter pelo menos 7 letras',
            'morada.required' => 'Morada é obrigatório',
            'bi.unique' => 'Esse número de documento já existe',
            /* 'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo utilizado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter no mínimo 6 caracteres.' */
        ]);

        // Verificar se houve falhas na validação
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = "";

            foreach ($errors->keys() as $field) {
                $response = $errors->first($field);
            }

            return response()->json(['errors' => $response], 422);
        }
        $alunoData = [
            'aluno_nome' => $request->input('nome'),
            'aluno_doc_num' => $request->input('bi'),
            'aluno_data_nascimento' => $request->input('data_nascimento'),
            'aluno_genero' => $request->input('genero'),
            'aluno_naturalidade' => $request->input('naturalidade'),
            'aluno_provincia' => $request->input('provincia'),
            'aluno_morada' => $request->input('morada'),
            'aluno_nome_pai' => $request->input('nome_do_pai'),
            'aluno_nome_mae' => $request->input('nome_da_mae'),
            'aluno_id_classe' => $request->input('classe'),
            'aluno_id_turma' => $request->input('turma'),
            'aluno_id_sala' => $request->input('sala'),
            'aluno_id_ano_letivo' => 1,
            'id_funcionario' => 2


            // Adicione outros campos aqui, se necessário
        ];


        // Criação de um novo usuário
        Alunos::create($alunoData);

        // Redireciona ou retorna uma resposta adequada
        return response()->json(['message' => 'Registro realizado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Alunos $alunos)
    {

        $id_aluno = $request->id;
        $dados = Alunos::with('classe', 'turma', 'sala')->where('idtb_aluno', $id_aluno)->get();

        return Inertia::render('DetalhesAluno', ['dados' => $dados]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function edit(Alunos $alunos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alunos $alunos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alunos $alunos)
    {
        //
    }
}
