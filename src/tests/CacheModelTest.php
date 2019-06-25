<?php

namespace App\Models;

use PHPUnit\Framework\TestCase;

class CacheModelTest extends TestCase {

    public function testSetCacheConfigCorreto() {

        putenv('REDIS_HOST=localhost');
        putenv('REDIS_PORT=6379');
        putenv('REDIS_TTL=30');
        $key = "80030410";
        $val = ["testeCache"];
        $retorno = CacheModel::setCache($key, $val);
        $this->assertEquals($retorno, true );

    }
    public function testSetCacheConfigInCorreto() {

        putenv('REDIS_HOST=localhost');
        putenv('REDIS_PORT=6378');
        putenv('REDIS_TTL=30');
        $key = "80030411";
        $val = ["testeCache"];
        $x = CacheModel::setCache($key, $val);
        $this->assertEquals($x, false );

    }

    public function testGetCacheConfigCorreto() {

        putenv('REDIS_HOST=localhost');
        putenv('REDIS_PORT=6379');
        putenv('REDIS_TTL=30');
        $key = "8003044";
        $val = ["testeCache"];
        CacheModel::setCache($key, $val);
        $data = CacheModel::getByCache($key);
        $this->assertEquals($data, $val );

    }

    public function testGetCacheConfigInCorreto() {

        putenv('REDIS_HOST=localhost');
        putenv('REDIS_PORT=6378');
        putenv('REDIS_TTL=30');
        $key = "8003044";
        $val = ["testeCache"];
        CacheModel::setCache($key, $val);
        $data = CacheModel::getByCache($key);
        $this->assertEquals($data, null );

    }

}