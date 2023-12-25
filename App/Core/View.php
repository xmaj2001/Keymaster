<?php

namespace App\Core;

class View
{
    public static function include(string $file): void
    {
        if (file_exists(Page . $file . ".php")) {
            require Page . $file . ".php";
        } elseif (file_exists(Page . $file)) {
            require Page . $file;
        } else {
            echo "<p>Arquivo <b>{$file}</b> não existe</p>";
            echo "<p><small> Aqui => <b>" . Page . $file . "</b> arquivo <b>{$file}</b> não encontrado</small></p>";
        }
    }

    public static function Main(string $view): void
    {
        if ($view != "") {
            self::include($view);
        } else if (file_exists(Page . "index.php")) {
            require Page . "index.php";
        } else {
            echo "<p>Arquivo <b>index.php</b> não existe</p>";
            echo "<p><small> Aqui => <b>" . Page . "index.php</b> arquivo <b>index.php</b> não encontrado</small></p>";
        }
    }

    public static function Load(array $views = null): void
    {
        if ($views != null && count($views) > 0) {
            foreach ($views as $key => $value) {
                self::include($value);
            }
        } else if (file_exists(Page . "index.php")) {
            require Page . "index.php";
        } else {
            echo "<p>Arquivo <b>index.php</b> não existe</p>";
            echo "<p><small> Aqui => <b>" . Page . "index.php</b> arquivo <b>index.php</b> não encontrado</small></p>";
        }
    }
}
