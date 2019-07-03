<?php
/**
 * @todo colocar 'as' em todas as rotas
 */
$router->get(
    '/',
    function () use ($router) {
        return '<p>Acessar a Documentação nesse <a href="http://localhost:8088">link</a></p>';
    }
);

//Rotas Módulo Conta
$router->group(
    ['namespace' => '\App\conta\Http\Controllers', 'prefix' => '/conta'],
    function () use ($router) {
        $router->get(
            '/usuario/{token}',
            [
                'as' => 'usuario',
                'uses' => 'Autenticacao@usuario'
            ]
        );
    }
);

//Rotas Módulo NFe
$router->group(
    ['namespace' => '\App\Nfe\Http\Controllers', 'prefix' => '/nfe'],
    function () use ($router) {
        //Rotas Módulo NFe
        $router->post(
            '/gerar-nfe/{ambiente}',
            [
            'as' => 'gerar-nfe',
            'uses' => 'GerarNota@index'
            ]
        );

        $router->get(
            '/consultar-recibo/{recibo}/{ambiente}',
            [
            'as' => 'consultar-recibo',
            'uses' => 'ConsultarRecibo@index'
            ]
        );

        $router->get(
            '/consultar/{codigoAcesso}/{ambiente}',
            [
            'as' => 'consulta',
            'uses' => 'Consultar@get'
            ]
        );

        $router->get(
            '/distribuicao/{ambiente}/{certId}',
            [
            'as' => 'distribuicao',
            'uses' => 'Distribuicao@get'
            ]
        );

        $router->get(
            '/buscar-notas/{id}',
            [
            'as' => 'notas',
            'uses' => 'BuscarDadosNFe@buscarNFe'
            ]
        );

        $router->get(
            '/listar-notas/{usuario}',
            [
            'as' => 'notas',
            'uses' => 'ListarNFe@listarNotas'
            ]
        );

        $router->post(
            '/criar/{ambiente}/{certId}',
            [
            'as' => 'criar',
            'uses' => 'CriarNFe@index'
            ]
        );

        $router->get(
            '/download-local/{chNfe}',
            [
            'as' => 'download-local',
            'uses' => 'DownloadXml@get'
            ]
        );
    }
);


//Rotas parte Administrativa Certificado
$router->group(
    ['namespace' => '\App\Certificado\Http\Controllers', 'prefix' => '/admin'],
    function () use ($router) {

        //Rotas Módulo Certificado
        $router->post(
            '/certificado',
            [
            'as' => 'cadastrar-certificado',
            'uses' => 'Certificado@cadastrar'
            ]
        );
        $router->get(
            '/certificados',
            [
            'as' => 'listar-certificados',
            'uses' => 'Certificado@listar'
            ]
        );
        $router->delete(
            '/certificado/{id}',
            [
                'as' => 'excluir-certificados',
                'uses' => 'Certificado@excluir'
            ]
        );
        $router->put(
            '/certificado/{id}',
            [
                'as' => 'atualizar-certificado',
                'uses' => 'Certificado@atualizar'
            ]
        );
    }
);
