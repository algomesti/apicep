<?php

namespace App\Models;


class CacheModel {


    public static function cache(): ?\Predis\Client {


        try {
            $redis = new \Predis\Client(array("host"=>getenv('REDIS_HOST'), "port"=>getenv('REDIS_PORT')));
            return $redis;
        } catch (\Throwable $e) {
            return null;
        }


    }

    public static function setCache(string $cep, array $data): ?bool {

        try {
            $b64 = base64_encode(json_encode($data));
            $cache = self::cache();
            $cache->set($cep, $b64);
            $cache->expire($cep, getenv('REDIS_TTL'));
            return true;
        } catch (\Throwable $e) {
            return false;
        }

    }

    public static function getByCache(string $cep): ?array {

        try {
            $cache = self::cache();
            $return = $cache->get($cep);
            $return = json_decode(base64_decode($return), true);
            return $return;
        } catch(\Throwable $e) {
            return null;
        }

    }

    public static function getDataExternalEndPoint(string $cep): ?array {

        try{
            $uri = getenv('urlExternalCep') . $cep .getenv('urlExternalCepSuffix');
            $data = @file_get_contents($uri);
            return json_decode($data, true);
        } catch (\Throwable $e) {
            return null;
        }

    }

    public static function trataCep(string $cep): ?string {

        return str_pad(preg_replace("/[^0-9]/","", $cep),8,"0",STR_PAD_LEFT);

    }


}