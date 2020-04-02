<?php

return [
    'env' => getenv('APP_ENV') ?: 'local',
    'jwt' => getenv('JWT_KEY'),
    'jwt_validity' => 24 * 30, // validity in hours
];