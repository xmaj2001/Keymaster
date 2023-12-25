<?php

namespace App\Model\db;

trait Where
{
    private static $conditions = [];
    private static $operator = "OR";
    private static $limit = "";
    private static $orderBy = "";

    public static function or()
    {
        self::$operator = "OR";
    }

    public static function and()
    {
        self::$operator = "AND";
    }
    public static function id($value)
    {
        self::where("id", "=", $value);
    }
    public static function login($email, $senha)
    {
        self::where("email", "=", $email);
        self::and();
        self::where("senha", "=", $senha);
    }
    public static function href($value)
    {
        self::where("href", "=", $value);
    }

    public static function like($column, $value)
    {
        self::where($column, "LIKE", "%" . $value . "%");
    }

    public static function where($column, $operator, $value)
    {
        if (!empty(self::$conditions)) {
            $condition = self::$operator . " " . $column . " " . $operator . " '" . $value . "'";
            if (!in_array($condition, self::$conditions)) {
                self::$conditions[] = $condition;
            }
        } else {
            self::$conditions[] = $column . " " . $operator . " '" . $value . "'";
        }
    }

    public static function Wquery(string $query)
    {
        self::WipeWhere();
        self::$conditions[] = $query;
    }

    public static function limit($limit, $offset = 0)
    {
        self::$limit = "LIMIT " . $offset . ", " . $limit;
    }

    public static function orderBy($column = "id", $type = "DESC")
    {
        self::$orderBy = "ORDER BY " . $column . " " . $type;
    }

    public static function getWhere(): string
    {
        $conditions = implode(" ", self::$conditions);
        $query = "";
        if (!empty($conditions)) {
            $query .= "WHERE " . $conditions;
        }
        if (!empty(self::$orderBy)) {
            $query .= " " . self::$orderBy;
        }
        if (!empty(self::$limit)) {
            $query .= " " . self::$limit;
        }
        return $query;
    }

    private static function WipeWhere()
    {
        self::$conditions = [];
        self::$operator = "OR";
        self::$limit = "";
        self::$orderBy = "";
    }
}
