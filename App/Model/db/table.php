<?php

namespace App\Model\db;

trait table
{
    private static $table_name = "";
    public static function tableName($table_name) 
    {
        self::$table_name = $table_name;
    }

    private static function table_name() : string
    {
        return self::$table_name;
    }
}
