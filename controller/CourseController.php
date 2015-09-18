<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();
require '../mapper/CourseMapper.php';

// GET route
$app->get ( '/school/:school_id/dept/:dept_id', function ($school_id, $dept_id) {
    $courseList = CourseMapper::selectCourseByParam($school_id, $dept_id);
    echo json_encode ( $courseList );
} );

$app->run ();