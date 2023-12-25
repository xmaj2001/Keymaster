<?php

namespace App\Core;

class Page
{
    public static string $lang = "pt";
    public static string $viewport = "width=device-width, initial-scale=1.0";
    public static string $author = "";
    public static string $keywords = "";
    public static string $description = "";
    public static string $titulo = "Keymaster";
    public static string $image = "";
    public static string $url = "";
    public static string $site_name = "";
    public static string $card = "";
    public static array $views = [];
    public static string $view = "";
    public static string $logo =  img . "favicon.ico";
    public static function SetDate(mixed $date): void
    {
        define("Date",  $date);
    }
    public static function Load(string $Layout = "layout.php")
    {   
        if (file_exists(Layouts . $Layout . ".php")) {
            require Layouts . $Layout . ".php";
        } elseif (file_exists(Layouts . $Layout)) {
            require Layouts . $Layout;
        } else {
            echo "<p>Arquivo <b>{$Layout}</b> não existe.</p>";
            echo "<p><small> Aqui => <b>" . Layouts . $Layout . "</b> arquivo <b>{$Layout}</b> não encontrado</small></p>";
        }
    }
}
