<?php

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositoryAlunoMemory;

require("vendor/autoload.php");

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];
$aluno = Aluno::comCpfEmailNome($cpf, $nome, $email)->AdicionarTelefone($ddd, $numero);
$repository = new RepositoryAlunoMemory();
$repository->adicionar($aluno);