<?php

namespace App\Model\db;

class Paginacao
{
    public static $Itens = [];
    public static $Paginas = 0;
    public static $Pagina = 0;
    public static $Pagina_Seguinte = 0;
    public static $Pagina_Anterior = 0;
    
    public static function  getMap(){
        return [
            "itens" =>self::$Itens,
            "Paginas" =>self::$Paginas,
            "Pagina" =>self::$Pagina,
            "Seguinte" =>self::$Pagina_Seguinte,
            "Anterior" =>self::$Pagina_Anterior,
        ];
    }
}
