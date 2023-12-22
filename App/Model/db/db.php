<?php

namespace App\Model\db;

use App\Model\db\conector;
class db extends conector
{
    
    // modelos
    use table;
    use modelo_select;
    use ModeloInsert;
    use ModeloUpdate;
    use modelo_deletar;
    use modelo_validar;
    use Where;
    // Model query
    public static function query($query, $conector = null)
    {
        try {
            $db = $conector ?? self::getConector();
            if ($db != null) {
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                return $stmt->fetchAll() ?? null;
            }
        } catch (\Throwable $th) {
            die("Erro no query : " . $th);
        }
        $db = null;
    }
}
