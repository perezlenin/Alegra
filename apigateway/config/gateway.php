<?php

return [
    // Global parameters
    'global' => [
        'base_url' => 'http://128.199.1.63/'
    ],

    // List of microservices behind the gateway
    'services' => [
        'account' => '22.22.22.22',
        'hr-service' => ''
    ],

    //Public Endpoints
    'endpoints' => [
        'recetas' => '172.17.0.2',
        'historial' => '172.17.0.5',
        'ingredientes' => '172.17.0.4',
        "pedidos" => '172.17.0.6'
    ],

];
