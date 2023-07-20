<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $tabele = 'alunos';

    public $timestamps = false;

    protected $fillable = [
        /*  'aluno_code', */
        'aluno_nome',
        'aluno_doc_num',
        'aluno_data_nascimento',
        'aluno_genero',
        'aluno_naturalidade',
        'aluno_provincia',
        'aluno_morada',
        'aluno_nome_pai',
        'aluno_nome_mae',
        'aluno_id_classe',
        'aluno_id_turma',
        'aluno_id_sala',
        'aluno_id_ano_letivo',
        'id_funcionario',
    ];
}
