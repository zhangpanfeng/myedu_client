<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();
require '../mapper/CourseMapper.php';

// GET route
$app->get ( '/course/:school_id', function ($school_id) {
    $courseList = CourseMapper::selectCourseBySchoolId($school_id);
    echo json_encode ( $courseList );
} );

$app->run ();