<?php

require_once("conecta_bd.php");

class Alimento {
    private $conexao;

    public function __construct() {
        $this->conexao = conecta_bd();
    }

    public function listaAlimentos() {
        $alimentos = array();
        $query = "SELECT * FROM alimento ORDER BY cod";
        $resultado = mysqli_query($this->conexao, $query);
        while ($dados = mysqli_fetch_array($resultado)) {
            array_push($alimentos, $dados);
        }
        return $alimentos;
    }

    public function buscarAlimento($codigo) {
        $query = "SELECT * FROM alimento WHERE cod = '$codigo'";
        $resultado = mysqli_query($this->conexao, $query);
        $dados = mysqli_fetch_array($resultado);
        return $dados;
    }

    public function cadastraAlimento($nome, $valor, $quantidade, $data) {
        $query = "INSERT INTO alimento (nome, valor, quantidade, data) 
                  VALUES ('$nome', '$valor', '$quantidade', '$data')";
        $resultado = mysqli_query($this->conexao, $query);
        return mysqli_affected_rows($this->conexao);
    }

    public function removerAlimento($codigo) {
        $query = "DELETE FROM alimento WHERE cod = '$codigo'";
        $resultado = mysqli_query($this->conexao, $query);
        return mysqli_affected_rows($this->conexao);
    }

    public function editarAlimento($codigo, $nome, $valor, $quantidade, $data) {
        $query = "UPDATE alimento 
                  SET nome = '$nome', valor = '$valor', quantidade = '$quantidade', data = '$data' 
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($this->conexao, $query);
        return mysqli_affected_rows($this->conexao);
    }

    public function __destruct() {
        mysqli_close($this->conexao);
    }
}

?>
