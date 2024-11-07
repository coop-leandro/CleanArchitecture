<?php
namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Dominio\Aluno\AlunoRepository;
use Alura\Arquitetura\Dominio\Cpf;

class RepositorioDeAlunoComPDO implements AlunoRepository{
    private $conn;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }

    public function adicionar(Aluno $aluno) : void {

        $sql = 'INSERT INTO alunos VALUES(:cpf, :nome, :email)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':cpf', $aluno->cpf());
        $stmt->bindValue(':nome', $aluno->nome());
        $stmt->bindValue(':email', $aluno->email());
        $stmt->execute();

        $sql = 'INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno)';
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindValue(':cpf_aluno', $aluno->cpf());

        foreach($aluno->telefones() as $telefone){
            $stmt->bindValue(':ddd', $telefone->ddd());
            $stmt->bindValue(':numero', $telefone->numero());
            $stmt->execute();
        }

    }
    public function FindByCpf(Cpf $cpf) : Aluno
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone FROM alunos
        LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf
        WHERE alunos.cpf = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, (string) $cpf);
        $stmt->execute();

        $dadosAlunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(count($dadosAlunos) === 0){
            throw new AlunoNaoEncontrado($cpf);
        }
        return $this->mapearAluno($dadosAlunos);
    }

    private function mapearAluno(array $dadosAlunos): Aluno{
        $primeiraLinha = $dadosAlunos[0];
        $aluno = Aluno::comCpfEmailNome($primeiraLinha['cpf'], $primeiraLinha['nome'], $primeiraLinha['email']);
        $telefones = array_filter($dadosAlunos, fn ($linha) => $linha['ddd'] !== null && $linha['numero_telefone'] !== null);
        foreach($telefones as $linha){
            $aluno->AdicionarTelefone($linha['ddd'], $linha['numero_telefone']);
        }
        return $aluno;
    }

    public function FindAll(): array
    {
        
        $sql = '
            SELECT cpf, nome, email, ddd, numero as numero_telefone
              FROM alunos
         LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf;
        ';
        $stmt = $this->conn->query($sql);

        $listaDadosAlunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $alunos = [];

        foreach ($listaDadosAlunos as $dadosAluno) {
            if (!array_key_exists($dadosAluno['cpf'], $alunos)) {
                $alunos[$dadosAluno['cpf']] = Aluno::comCpfEmailNome(
                    $dadosAluno['cpf'],
                    $dadosAluno['nome'],
                    $dadosAluno['email']
                );
            }

            $alunos[$dadosAluno['cpf']]->adicionarTelefone($dadosAluno['ddd'], $dadosAluno['numero_telefone']);
        }

        return array_values($alunos);
    }
}
