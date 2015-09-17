<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();

require '../utils/Util.php';
require '../mapper/CourseMapper.php';
require '../mapper/SchoolMapper.php';

// POST route
$app->post ( '/', function () {
    $result = '{"status":"error"}';
    $base_url = "http://localhost/myedu_rest/index.php/school/";
    if ($_POST ["school_id"] == "-1") {
        // loop all the schools
        $schoolList = SchoolMapper::selectAllSchools ();
        foreach ( $schoolList as $school ) {
            $url = $base_url . $school["school_id"];
            $courseList = Util::callApiWithGet ( $url );
            $result = CourseMapper::saveOrUpdate ( $courseList );
        }
    } else {
        // search one school
        $url = $base_url . $_POST ["school_id"];
        $courseList = Util::callApiWithGet ( $url );
        $result = CourseMapper::saveOrUpdate ( $courseList );
    }
    
    echo $result;
} );

$app->run ();