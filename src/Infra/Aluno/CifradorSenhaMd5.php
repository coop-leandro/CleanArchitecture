<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\CifradorSenha;

class CifradorSenhaMd5 implements CifradorSenha{
    public function cifrar(string $senha): string{
        return md5($senha);
    }
    public function verificar(string $senhaTexto, string $senhaCifrada): bool{
        return md5($senhaTexto) === $senhaCifrada;
    }
}