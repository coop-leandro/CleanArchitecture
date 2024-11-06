<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Aluno\Telefone;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;

class Aluno
{

    public static function comCpfEmailNome(string $cpf, string $email, string $nome)
    {
        return new Aluno(new Cpf($cpf), $nome, new Email($email));
    }

    public function __construct(CPF $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->email = $email;
        $this->nome = $nome;
    }

    private CPF $cpf;
    private string $nome;
    private Email $email;
    private array $telefones;

    public function AdicionarTelefone(string $ddd, string $numero)
    {
        $this->telefones[] = new Telefone($ddd, $numero);
        return $this;
    }
}