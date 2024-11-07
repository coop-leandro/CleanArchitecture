<?php

namespace Alura\Arquitetura\Dominio\Aluno\MatricularAluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoRepository;

class MatricularAluno
{
    private AlunoRepository $alunoRepository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    public function executa(MatricularAlunoDto $dados): void
    {
        $aluno = Aluno::comCpfEmailNome($dados->cpfAluno, $dados->emailAluno, $dados->nomeAluno);
        $this->alunoRepository->adicionar($aluno);
    }
}
