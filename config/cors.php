<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'storage/*'],  // Agregar 'storage/*' para permitir acceder a las imágenes

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://restaurant-front-blue.vercel.app',
        'http://localhost:5173', // para desarrollo local
    ], // El origen de tu frontend en Vue.js

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
