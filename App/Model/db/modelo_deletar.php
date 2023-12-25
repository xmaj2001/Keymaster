<?php

namespace App\Model\db;

trait modelo_deletar
{
    use table;
    public static function deletar(array $where, $conector = null)
    {
        try {
            $db = $conector;
            $tabela = self::table_name() != "" ? self::table_name() : "";
            if (!isset($db)) {
                $db = self::getConector();
            }
            if ($db != null) {
                $query = "DELETE FROM {$tabela} $where";
                $resut = $db->query($query);
                return $resut;
            }
        } catch (\Throwable $th) {
            die("Erro deletar o item: " . $th);
        }
    }
    /**
     * * @param string $key remover poste para não afetar o registro
     */
    public static function remove($key)
    {
        unset($_POST[$key]);
    }
    
    public static function Trancate($conector = null)
    {
        try {
            $db = $conector;
            $tabela = self::table_name() != "" ? self::table_name() : "";
            if (!isset($db)) {
                $db = self::getConector();
            }
            if ($db != null) {
                $query = "TRUNCATE TABLE {$tabela}";
                $resut = $db->query($query);
                return $resut;
            }
        } catch (\Throwable $th) {
            die("Erro ao limpar a Tabela: " . $th);
        }
    }
}
