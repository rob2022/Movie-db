<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    $response = 'hello';

    return $response;
});
