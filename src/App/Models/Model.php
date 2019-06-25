<?php

namespace App\Models;

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

class Model extends CacheModel {


    public static function start() {


        return $log;

    }

    public static function log() {

        $log = new Logger(getenv('LOG_NAME'));
        $log->pushProcessor(new UidProcessor());
        $log->pushHandler(new StreamHandler(getenv('LOG_PATH') , Logger::DEBUG ));
        return $log;
    }


}