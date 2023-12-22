<?php

namespace App\Core;

class View
{
    public static function Header(): void
    {
        if (file_exists(Page . Page_Header . ".php")) {
            require Page . Page_Header . ".php";
        } else {
            echo Page_Header;
        }
    }

    public static function Main(): void
    {
        if (file_exists(Page . Page_Main . ".php")) {
            require Page . Page_Main . ".php";
        } else {
            echo Page_Main;
        }
    }

    public static function Footer(): void
    {
        if (file_exists(Page . Page_Footer . ".php")) {
            require Page . Page_Footer . ".php";
        } else {
            echo Page_Footer;
        }
    }
}
