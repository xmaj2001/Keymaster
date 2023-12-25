<?php

namespace App\Model\db;

use PDOException;

trait ModeloInsert
{
    use table;
    // Model Registrar
    public static function Registrar($entidade, $db = null): int
    {
        try {
            $db = $db ?? self::getConector();
            $tabela = self::table_name() != "" ? self::table_name() : ""; // obtém uma conexão com o banco de dados se não for fornecida
            $colunas = array_keys($entidade);
            $valores = array_values($entidade);
            $placeholders = array_fill(0, count($valores), '?');
            $sql = "INSERT INTO {$tabela} (" . implode(',', $colunas) . ") VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $db->prepare($sql);
            $stmt->execute($valores);
            return $stmt->rowCount(); // retorna o número de linhas afetadas pela operação
        } catch (PDOException $e) {
            // trata a exceção adequadamente, por exemplo, logando o erro ou lançando uma exceção personalizada
        }
    }

    public static function Registrar_getid($entidade, $db = null): int
    {
        try {
            $db = $db ?? self::getConector();
            $tabela = self::table_name() != "" ? self::table_name() : "";
            $colunas = array_keys($entidade);
            $valores = array_values($entidade);
            $placeholders = array_fill(0, count($valores), '?');
            $sql = "INSERT INTO {$tabela} (" . implode(',', $colunas) . ") VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $db->prepare($sql);
            $stmt->execute($valores);
            return $db->lastInsertId(); // retorna o ID da última linha inserida
        } catch (PDOException $e) {
            // trata a exceção adequadamente
        }
    }
}
