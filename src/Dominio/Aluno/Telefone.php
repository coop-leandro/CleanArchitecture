<?php

namespace Alura\Arquitetura\Dominio\Aluno;

class Telefone
{
    private string $ddd;
    private string $numero;

    public function __construct(string $ddd, string $numero)
    {
        $this->ddd = $ddd;
        $this->numero = $numero;
    }

    public function setDdd(string $ddd): void
    {
        if (preg_match('/^\d{2}$/', $ddd)) {
            $this->ddd = $ddd;
        } else {
            throw new \InvalidArgumentException("DDD deve conter exatamente 2 dígitos.");
        }
    }

    public function setNumero(string $numero): void
    {
        if (preg_match('/^\d{8,9}$/', $numero)) {
            $this->numero = $numero;
        } else {
            throw new \InvalidArgumentException("Número deve conter entre 8 e 9 dígitos.");
        }
    }

    public function __toString()
    {
        return "({$this->ddd}) {$this->numero}";
    }

    public function ddd() : string{
        return $this->ddd;
    }

    public function numero() : string{
        return $this->numero;
    }

}
