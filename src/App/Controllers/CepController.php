<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\CepModel;

final class CepController {

    
    public function root(Request $request, Response $response, array $args) {

        $response = $response->withJson([
           'Busca Cep'
        ]);
        return $response;

    }

    public function get(Request $request, Response $response, array $args) {

        CepModel::log()->debug('Entra endpoint '. __METHOD__.'  ', $args);
        $data = CepModel::get($args['cep']);
        if($data === null) {
            CepModel::log()->debug('Retornou null  '. __METHOD__.'  ', $args);
            $code = 404;
            $data = ['cep'=>$args['cep'], 'erro'=>'nao localizado na base'];
        } else {
            CepModel::log()->debug('Retornou válido  '. __METHOD__.'  ', $args);
            $code = 200;
            $data = $data;
        }
        $response = $response->withJson(
            $data, $code
        );
        CepModel::log()->debug('Sai endpoint '. __METHOD__.'  ', $args);
        return $response;
    }


}
