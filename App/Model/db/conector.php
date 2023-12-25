<?php

namespace App\Model\db;

class Conector
{
    private static $servername = db_host;
    private static $username = db_user;
    private static $password = db_pwd;
    private static $dbname = db_db;

    /**
     * Retorna uma conexão com o banco de dados
     *
     * @return \PDO|false Retorna uma conexão MySQLi válida ou FALSE em caso de falha
     */
    public static function getConector(): \PDO
    {
        try {
            $conn = new \PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
            // $conn = new \mysqli(self::$servername, self::$username, self::$password, self::$dbname);

            // Verificar conexão
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $th) {
            die("Falha ao conectar-se a Base de Dados: " . $th->getMessage());
        }
    }
}
