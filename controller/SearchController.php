<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();
require '../mapper/CourseMapper.php';

// GET route
$app->get ( '/search/:school_id', function ($school_id) {
    $courseList = CourseMapper::selectCourseBySchoolId ( $school_id );
    //echo json_encode ( $courseList );
    create_index($courseList);
} );

function create_index($courseList) {
    // Elastic search php client
    $client = new Elasticsearch\Client ();
//     $sql = "SELECT * FROM log";
//     $conn = get_conn ();
//     $stmt = $conn->query ( $sql );
//     $rtn = $stmt->fetchAll ();
    
    // delete index which already created
    echo json_encode($client);
    $params = array ();
    $params ['index'] = 'course_index';
   // $client->indices ()->delete ( $params );
    
    // create index on log_date,src_ip,dest_ip
//     $rtnCount = count ( $rtn );
//     for($i = 0; $i < $rtnCount; $i ++) {
//         $params = array ();
//         $params ['body'] = array (
//                 'log_date' => $rtn [$i] ['log_date'],
//                 'src_ip' => $rtn [$i] ['src_ip'],
//                 'dest_ip' => $rtn [$i] ['dest_ip'] 
//         );
//         $params ['index'] = 'log_index';
//         $params ['type'] = 'log_type';
        
//         // Document will be indexed to log_index/log_type/autogenerate_id
//         $client->index ( $params );
//     }
    $params = array ("id"=>"001");
    $client->index ( $params );
    echo 'create index done!';
}
$app->run ();