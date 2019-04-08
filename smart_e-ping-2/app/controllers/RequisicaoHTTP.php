<?php

class RequisicaoHTTP extends Controller{
    public static function insert($dataJSON, $orionIP, $orionPort) {
        $status = array(
            "qtdErro" => 0,

            "qtdEntities" => count($dataJSON),
            "description" => []
        );

        error_reporting(0);

        foreach ($dataJSON as $entities){
            // echo json_encode($entities, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "<br><br>";

            $result = file_get_contents(
                'http://' . $orionIP . ':' . $orionPort . '/v2/entities',
                null,
                stream_context_create(
                    array(
                        'http' => array(
                            'method' => 'POST',
                            'header' => 'Content-Type: application/json' . "\r\n",
                            'content' => json_encode($entities, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                        ),
                    )
                )
            );

            if($result === false){
                $status['qtdErro']++;
                $status['description'][] =
                    "Não foi possível registrar o elemento: tabela = "
                    . $entities['type']
                    . ", ID = " . explode($entities['type'] . '_', $entities['id'])[1];
            }
        }

        return $status;
    }
}
