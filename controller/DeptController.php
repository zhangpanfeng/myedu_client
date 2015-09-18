<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();
require '../mapper/DeptMapper.php';

// GET route
$app->get ( '/dept/:school_id', function ($school_id) {
    $deptList = DeptMapper::selectDeptListBySchoolId($school_id);
    echo json_encode ( $deptList );
} );

$app->run ();