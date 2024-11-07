<?php

namespace Alura\Arquitetura\Dominio\Aluno;

interface CifradorSenha{
    public function cifrar(string $senha): string;
    public function verificar(string $senhaTexto, string $senhaCifrada): bool;
}