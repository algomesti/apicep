<?php
use function config\slimConfiguration;
use \App\Controllers\CepController;
$app = new \Slim\App(slimConfiguration());

$app->get('/',CepController::class.':root');
$app->get('/get/{cep}',CepController::class.':get');


$app->run();
