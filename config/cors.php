<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'storage/*'],  // Agregar 'storage/*' para permitir acceder a las imágenes

    'allowed_methods' => ['*'],

    'allowed_origins' => [
    'http://localhost:5173',  // Desarrollo local
    'https://zingy-brioche-36c7f0.netlify.app',  // Reemplaza con tu URL real de Netlify
    'https://restaurant-back-z4n3.onrender.com'  // Tu backend en Render
],  // El origen de tu frontend en Vue.js

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];

