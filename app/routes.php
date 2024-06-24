<?php

    /** @noinspection PhpParamsInspection */
    /** @noinspection SpellCheckingInspection */
    /** @noinspection PhpUndefinedVariableInspection */

    use App\Middleware\Authentication;
    $container = $app->getContainer();

    //AREA COLABORADOR
    $app->get('/area_colaborador/receptivo', 'App\Controller\AreaColaboradorController:receptivo')
        ->setName('root');
    $app->get('/area_colaborador/passo1', 'App\Controller\AreaColaboradorController:passo1')
        ->setName('root');
    $app->get('/area_colaborador/passo2', 'App\Controller\AreaColaboradorController:passo2')
        ->setName('root');
    $app->get('/area_colaborador/passo3', 'App\Controller\AreaColaboradorController:passo3')
        ->setName('root');

    $app->get('/area_colaborador/passo4', 'App\Controller\AreaColaboradorController:passo4')
    ->setName('root');

    $app->get('/area_colaborador/tirar_foto_novo_registro', 'App\Controller\AreaColaboradorController:tirarFotoNovoRegistro')
    ->setName('root');

    //REGISTRAR PONTO
    $app->get('/area_colaborador/receptivoRegistrarPonto', 'App\Controller\AreaColaboradorController:receptivoRegistrarPonto')
    ->setName('root');

    $app->get('/area_colaborador/receptivoRegistrarPontoPorPin', 'App\Controller\AreaColaboradorController:receptivoRegistrarPontoPorPin')
    ->setName('root');


    //new Authentication($container) faz a verificação para ver se tem algum usuário logado.

    //MENU
    $app->get('/', 'App\Controller\AreaColaboradorController:receptivo')
        ->setName('root');


   


    
