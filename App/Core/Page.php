<?php

namespace App\Core;

class Page
{
    private static string $Lang = "pt";
    private static string $viewport = "width=device-width, initial-scale=1.0";
    private static string $author = "";
    private static string $keywords = "";
    private static string $description = "";
    private static string $titulo = "Keymaster";

    private static string $image = "";
    private static string $url = "";
    private static string $site_name = "";
    private static string $card = "";
    private static string $logo =  img . "favicon.ico";

    private static string $Header = "";
    private static string $Main = "";
    private static string $Footer = "";
    private static $Dados = null;

    private static function DefineDetails(): void
    {
        // -----Head-----
        define("Page_lang", self::$Lang);
        define("Page_viewport", self::$viewport);
        define("Page_author", self::$author);
        define("Page_keywords", self::$keywords);
        define("Page_description", self::$description);
        define("Page_titulo", self::$titulo);
        // Partilha
        define("Page_image", self::$image);
        define("Page_url", self::$url);
        define("Page_site_name", self::$site_name);
        define("Page_card", self::$card);
        // Logo
        define("Page_logo", self::$logo);
        // -----Head----

        // -----Body----
        define("Page_Header", self::$Header);
        define("Page_Main", self::$Main);
        define("Page_Footer", self::$Footer);
        // -----------
        define("Page_dados", self::$Dados);
    }

    public static function Lang(string $valor = "pt")
    {
        self::$Lang =  $valor;
    }

    public static function Viewport(string $valor = "width=device-width, initial-scale=1.0")
    {
        self::$viewport =  $valor;
    }

    public static function Author(string $valor)
    {
        self::$author =  $valor;
    }

    public static function Keywords(string $valor)
    {
        self::$keywords = $valor;
    }

    public static function Description(string $valor)
    {
        self::$description = $valor;
    }

    public static function Titulo(string $valor = "Keymaster")
    {
        self::$titulo = $valor;
    }

    public static function Image(string $valor)
    {
        self::$image =  img . $valor;
    }

    public static function Url(string $valor)
    {
        self::$url = $valor;
    }

    public static function Site_Name(string $valor)
    {
        self::$site_name = $valor;
    }

    public static function Card(string $valor)
    {
        self::$card = $valor;
    }

    public static function Logo(string $valor = "favicon.ico")
    {
        self::$logo = img . $valor;
    }

    public static function Dados($valor)
    {
        self::$Dados = $valor;
    }

    public static function Header(string $valor = "header")
    {
        self::$Header = $valor;
    }

    public static function Main(string $valor = "index")
    {
        self::$Main = $valor;
    }

    public static function Footer(string $valor = "footer")
    {
        self::$Footer = $valor;
    }

    public static function Load(string $Layoutpath = "Layout"): void
    {
        if (file_exists(Layouts . $Layoutpath . ".php")) {
            self::DefineDetails();
            require Layouts . $Layoutpath . ".php";
        } else {
            echo "Layout " . $Layoutpath . " não foi encontrado";
        }
    }

    public static function is_ajax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }
}
