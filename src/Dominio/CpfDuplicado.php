<?php

namespace Alura\Arquitetura\Dominio;

class CpfDuplicadoException extends \Exception
{
    public function __construct(string $message = "CPF duplicado encontrado.", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
