<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\CpfDuplicadoException;

class RepositoryAlunoMemory
{
    private array $alunos = [];

    public function adicionar(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function FindByCpf(Cpf $cpf): Aluno
    {
        $alunosFiltrados = array_filter(
            $this->alunos,
            fn(Aluno $aluno) => $aluno->cpf() == $cpf
        );

        if (count($alunosFiltrados) === 0) {
            throw new AlunoNaoEncontrado($cpf);
        }

        if (count($alunosFiltrados) > 1) {
            throw new CpfDuplicadoException("Há mais de um aluno com o CPF {$cpf}");
        }

        return $alunosFiltrados[0];
    }


    public function buscarTodos(): array
    {
        return $this->alunos;
    }
}
