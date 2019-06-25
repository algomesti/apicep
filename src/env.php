<?php

putenv('DISPLAY_ERROR_DETAILS='.true);
putenv('urlExternalCep=https://viacep.com.br/ws/');
putenv('urlExternalCepSuffix=/json/');

$path = isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/logs/app.log';
putenv('LOG_NAME=apicep');

putenv('LOG_PATH='.$path);
putenv('LOG_LEVEL=logger::DEBUG');

putenv('REDIS_HOST=localhost');
putenv('REDIS_PORT=6379');
putenv('REDIS_TTL=30');