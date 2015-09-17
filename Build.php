<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim ();

require 'Util.php';
// POST route
$app->post ( '/', function () {
    echo json_encode ( $_POST );
    $courseList = Util::callApiWithGet("http://localhost/myedu_rest/index.php");
    echo json_encode($courseList);
} );

    
$app->run ();