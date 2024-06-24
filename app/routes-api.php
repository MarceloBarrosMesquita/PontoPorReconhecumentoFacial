<?php

use App\Middleware\Authentication;

$app->group('/api', function () use ($app) {

    $container = $app->getContainer();


    //AREA DO COLABORADOR
    $app->group('/area_colaborador', function () use ($app) {
        $app->post('/buscarColaborador', 'App\Controller\AreaColaboradorController:buscarColaborador')->setName('buscarColaborador');
        $app->post('/salvarPrimeiroRegistro', 'App\Controller\AreaColaboradorController:salvarPrimeiroRegistro')->setName('salvarPrimeiroRegistro');
        $app->post('/pegarInfoColaborador', 'App\Controller\AreaColaboradorController:pegarInfoColaborador')->setName('pegarInfoColaborador');
        $app->post('/salvarPonto', 'App\Controller\AreaColaboradorController:salvarPonto')->setName('salvarPonto');
        $app->post('/salvarCoordenadas', 'App\Controller\AreaColaboradorController:salvarCoordenadas')->setName('salvarPonto');
        $app->post('/listarTodosPostTrabalho', 'App\Controller\AreaColaboradorController:listarTodosPostTrabalho')->setName('listarTodosPostTrabalho');
    });
});


