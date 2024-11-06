<?php

namespace Alura\Arquitetura\Dominio\Indicacao;

use Alura\Arquitetura\Dominio\Aluno\Aluno as Aluno;
use DateTimeImmutable;

class Indicacao
{
    private Aluno $indicante;
    private Aluno $indicado;
    private \DateTimeImmutable $data;

    public function __construct(Aluno $indicante, Aluno $indicado)
    {
        $this->indicado = $indicado;
        $this->indicante = $indicante;
        $this->data = new DateTimeImmutable();
    }
}
