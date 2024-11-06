<?php 

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;

interface AlunoRepository{
    public function adicionar(Aluno $aluno) : void;
    public function FindByCpf(Cpf $cpf) : Aluno;
    public function FindAll() : array; 
}