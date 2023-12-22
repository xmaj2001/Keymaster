<?php

namespace App\Model\db;


trait ModeloUpdate
{
    use Where;
    use table;
    // Atualizar modelo
    public static function atualizar(?array $dados = null, ?object $conector = null): bool
    {
        try {
            $db = $conector ?: self::getConector();
            $campos = '';

            if (!isset($dados)) {
                $postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                unset($postData['btn_add'], $postData['btn_sv'], $postData['btn_del']);

                if (empty($postData)) {
                    throw new \Exception('Não existe nenhum post');
                }

                $numCampos = count($postData);
                $contador = 0;

                foreach ($postData as $campo => $valor) {
                    $contador++;

                    if ($contador >= $numCampos) {
                        $campos .= "$campo = '$valor'";
                        break;
                    }

                    $campos .= "$campo = '$valor', ";
                }
            } else {
                if (!is_array($dados)) {
                    throw new \InvalidArgumentException('A variável $dados precisa ser um array');
                }

                $numCampos = count($dados);
                $contador = 0;

                foreach ($dados as $campo => $valor) {
                    $contador++;

                    if ($contador >= $numCampos) {
                        $campos .= "$campo = '$valor'";
                        break;
                    }

                    $campos .= "$campo = '$valor', ";
                }
            }
            $nomeDaTabela = self::table_name();
            $where = self::getWhere();
            $query = "UPDATE $nomeDaTabela SET $campos $where";
            $resut = $db->query($query);

            return $resut;
        } catch (\Throwable $th) {
            throw new \Exception("Não foi possível fazer update: {$th->getMessage()}");
        }
    }
}
