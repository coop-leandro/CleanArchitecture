<?php

namespace Alura\Arquitetura\Dominio;

use Alura\Arquitetura\Dominio\Aluno\Aluno;

class FabricaAluno
{
    private Aluno $aluno;

    public function comCpfEmailNome(string $numeroCpf, string $email, string $nome)
    {
        $this->aluno = new Aluno(new Cpf($numeroCpf), $nome, new Email($email));
    }

    public function adicionaTelefone(string $ddd, string $numero)
    {
        $this->aluno->AdicionarTelefone($ddd, $numero);
        return $this;
    }

    public function aluno()
    {
        return $this->aluno;
    }
}
