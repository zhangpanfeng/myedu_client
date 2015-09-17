<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();
require '../mapper/SchoolMapper.php';

// GET route
$app->get ( '/', function () {
    $schoolList = SchoolMapper::selectAllSchools ();
    echo json_encode ( $schoolList );
} );

$app->run ();