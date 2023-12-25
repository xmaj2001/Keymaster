<?php

namespace Router\Config;

class ConfigRouter
{
    // Inicializar as Routas
    public static function IniciarRoutas() : void
    {
        $Routa = self::getRouta();
        $Routa->Controller();; 
    }
    public static function getRouta() : Routa
    {
        $Routas =  require Routas;
        $Url = parse_url(($_SERVER['REQUEST_URI']), PHP_URL_PATH);
        $Routa = self::InArrayRoute($Routas, $Url);
        $Params = [];
        if (empty($Routa)) {
            $Routa = self::RegularExpre($Routas, $Url);
            $Url = explode('/', ltrim($Url));
            $Params = self::getparametros($Url, $Routa);
            $Params = self::Formatarparametros($Url, $Params);
        }
        return new Routa($Routa,$Params);
    }
      // Comfirmar se routa Existe
    private static function InArrayRoute($routas, $Url)
    {
        if (array_key_exists($Url, $routas)) {
            return [$Url => $routas[$Url]];
        }
        return [];
    }
    // RegularExpre
    private static function RegularExpre($routas, $Url)
    {
        return array_filter(
            $routas,
            function ($value) use ($Url) {
                $regex = str_replace('/', '\/', ltrim($value, '/'));
                return preg_match("/^$regex$/", ltrim($Url, '/'));
            },
            ARRAY_FILTER_USE_KEY
        );
    }
    // Parametros
    private static function getparametros($Url, $rota)
    {
        if (!empty($rota)) {
            $parametro_rotas = array_keys($rota)[0];
            return array_diff(
                $Url,
                explode('/', ltrim($parametro_rotas))
            );
        }
        return [];
    }
    // Formatar Parametros
    private static function Formatarparametros($Url, $parametro)
    {
        $parametrodados = [];
        foreach ($parametro as $key => $value) {
            $parametrodados[$Url[$key - 1]] = $value;
        }
        return $parametrodados;
    }
}
