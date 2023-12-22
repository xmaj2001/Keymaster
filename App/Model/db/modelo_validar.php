<?php
namespace App\Model\db;

trait modelo_validar {
    // Validar campos
    public static function validar_campo(?string $texto, $conector = null): ?string
    {
        $db = $conector ?? self::getConector();

        if ($db != null) {
            return mysqli_escape_string($db, htmlspecialchars(addslashes($texto)));
        }

        return null;
    }

    public static function validar_post($conector = null): void
    {
        $db = $conector ?? self::getConector();

        if ($db != null && isset($_POST)) {
            $_POST = array_map(function($value) use ($db) {
                return mysqli_escape_string($db, htmlspecialchars(addslashes($value)));
            }, $_POST);
        }
    }
    // -------
}
