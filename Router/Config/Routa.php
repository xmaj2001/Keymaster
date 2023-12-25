<?php

namespace Router\Config;

class Routa
{
    public array $Routa = [];
    public array $Parametros = [];
    // Inicializar as Routas
    function __construct(array $routa, array $parametros)
    {
        $this->Routa = $routa;
        $this->Parametros = $parametros;
    }

    public function Controller()
    {
        if ($this->Routa != []) {
            [$Controller, $Metodo] = explode("@", array_values($this->Routa)[0]);
            // Caminho do arquivo do Controlador
            $file = Controllers . $Controller . ".php";
            if (file_exists($file)) {
                require $file;
                if (method_exists($Controller, $Metodo)) {
                    $Controller::$Metodo($this->Parametros);
                } else {
                    echo "O método " . $Metodo . " do Controlador " . $Controller . " Não foi localizado";
                }
            } else {
                echo "O arquivo do Controlador " . $Controller . " Não está presente na pasta App/Controller";
            }
        } else {
            echo "Está página não existe ";
        }
    }
}
