<?php

namespace App\Model\db;

trait modelo_select
{
    use Where;
    use table;
    // 
    public static function count($wipe = true): int
    {
        try {
            $db = $conector ?? self::getConector();
            $nometabela = self::table_name();
            if ($db != null && $nometabela != "") {
                $where = self::getWhere();
                if ($wipe) {
                    self::WipeWhere();
                }
                if ($where != "") {
                    $query = "SELECT *FROM {$nometabela} $where";
                } else {
                    $query = "SELECT *FROM {$nometabela}";
                }
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                return count($stmt->fetchAll()) ?? 0;
            }
        } catch (\PDOException $th) {
            die("<h4>Não foi possivel carregar todos os dados da tabela {$nometabela} :</h4>" . $th->getMessage());
        }
    }
    public static function SELECIONA(array $colunas = null, $wipe = true)
    {
        try {
            $db = $conector ?? self::getConector();
            $_colunas = $colunas != null ? implode(",", $colunas) : "*";
            $nometabela = self::table_name();
            if ($db != null && $nometabela != "") {
                $where = self::getWhere();
                if ($wipe) {
                    self::WipeWhere();
                }
                if ($where != "") {
                    $query = "SELECT {$_colunas} FROM {$nometabela} $where";
                } else {
                    $query = "SELECT {$_colunas} FROM {$nometabela}";
                }
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                return $stmt->fetchAll() ?? null;
            }
        } catch (\PDOException $th) {
            die("<h4>Não foi possivel carregar todos os dados da tabela {$nometabela} :</h4>" . $th->getMessage());
        }
    }

    public static function Linha(array $colunas = null, $wipe = true)
    {
        try {
            $db = $conector ?? self::getConector();
            $nometabela = self::table_name();
            $_colunas = $colunas != null ? implode(",", $colunas) : "*";
            if ($db != null && $nometabela != "") {
                $where = self::getWhere();
                if ($wipe) {
                    self::WipeWhere();
                }
                if ($where != "") {
                    $query = "SELECT {$_colunas} FROM {$nometabela} $where";
                } else {
                    $query = "SELECT {$_colunas} FROM {$nometabela}";
                }
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                return $stmt->fetchAll()[0] ?? null;
            }
        } catch (\PDOException $th) {
            die("<h4>Não foi possivel carregar todos os dados da tabela {$nometabela} :</h4>" . $th->getMessage());
        }
    }

    public static function Coluna($coluna, $wipe = true)
    {
        try {
            $db = $conector ?? self::getConector();
            $nometabela = self::table_name();
            if ($db != null && $nometabela != "") {
                $dbname = $nometabela;
                $where = self::getWhere();
                if ($wipe) {
                    self::WipeWhere();
                }
                $query = "SELECT $coluna FROM {$dbname} $where";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                return $stmt->fetchColumn() ?? null;
            } else {
                die("Não foi possivel conectar ao banco: ");
            }
        } catch (\PDOException $th) {
            die("<h4>Não foi possivel carregar todos os dados da tabela {$nometabela} :</h4>" . $th->getMessage());
        }
    }

    public static function Paginacao(int $itens, int $pagina_atual = 1, array $colunas = null): Paginacao
    {
        $paginas = ceil(self::count(false) / $itens);
        $pagina_atual = $pagina_atual > 0 ? $pagina_atual : 1;
        $itens = $itens > 0 ? $itens : 1;
        $pagina = $pagina_atual;
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }

        $inicial = ($itens * $pagina) - $itens;
        self::limit($itens, $inicial);
        $_itens = self::SELECIONA($colunas, false);

        $pg = new Paginacao();
        $pg::$Paginas = $paginas;
        $pg::$Pagina = $pagina;
        $pg::$Pagina = $pagina;
        $pg::$Pagina_Seguinte = $pagina + 1;
        $pg::$Pagina_Anterior = $pagina - 1;
        if ($pg::$Pagina_Anterior <= 0) {
            $pg::$Pagina_Anterior = 1;
        }

        if ($pg::$Pagina_Seguinte >= $paginas) {
            $pg::$Pagina_Seguinte = $paginas;
        }
        $pg::$Itens = $_itens;
        self::WipeWhere();
        return $pg;
    }
}
