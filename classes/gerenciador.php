<?php
class Gerenciador {
    private $conexao;
    
    public function __construct($conexao) {
        $this->conexao = $conexao;
    } 
    
    public function listar($tabela) {
        $sql = "SELECT * FROM $tabela";
        $resultado = mysqli_query($this->conexao, $sql);
        
        $registros = [];
        
        while ($registro = mysqli_fetch_assoc($resultado)) {
            $registros[] = $registro;
        }
        
        return $registros;
    }
    
    public function inserir($tabela, $dados) {
        $campos = implode(',', array_keys($dados));
        $valores = "'" . implode("','", array_values($dados)) . "'";
        
        $sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
        
        return mysqli_query($this->conexao, $sql);
    }
    
    public function buscar($tabela, $id) {
        $sql = "SELECT * FROM $tabela WHERE id = $id";
        $resultado = mysqli_query($this->conexao, $sql);
        
        return mysqli_fetch_assoc($resultado);
    }
    
    public function atualizar($tabela, $id, $dados) {
        $set = '';
        foreach ($dados as $campo => $valor) {
            $set .= "$campo = '$valor',";
        }
        $set = rtrim($set, ',');
        
        $sql = "UPDATE $tabela SET $set WHERE id = $id";
        
        return mysqli_query($this->conexao, $sql);
    }
    
    public function excluir($tabela, $id) {
        $sql = "DELETE FROM $tabela WHERE id = $id";
        
        return mysqli_query($this->conexao, $sql);
    }
}

