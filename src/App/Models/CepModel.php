<?php

namespace App\Models;



class CepModel extends Model{

    public static function get(string $cep): ?array {


        self::log()->info('Entrou no model '.__METHOD__, [$cep]);


        $array['cep_original'] = $cep;
        $cep = self::trataCep($cep);
        $array['cep_tratado'] = $cep;
        $cached = self::getByCache($cep);
        if ($cached !== null) {
            $array['is_cached'] = true;
            $array['data'] = $cached;
            $cache = self::cache();
            $array['ttl'] = $cache->ttl($cep);
            self::log()->info('Pegou do Cache '.__METHOD__, [$cep]);
        } else {
            $array['is_cached'] = false;
            $array['data'] = self::getDataExternalEndPoint($cep);
            if(is_array($array['data'])) self::setCache($cep, $array['data']);

            self::log()->info('Pegou do Endpoint '.__METHOD__, [$cep]);
            if($array['data'] === null) return null;
        }
        self::log()->info('Saiu no model '.__METHOD__, [$cep]);
        return $array;

    }


}