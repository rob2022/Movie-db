<?php
use App\Controllers\MovieController;


// Routes
$app->group('/api', function () {
    $this->group('/v1', function () {
        $this->get('/movie', MovieController::class . ':index');
        $this->get('/movie/{id}', MovieController::class . ':show');
    });
});