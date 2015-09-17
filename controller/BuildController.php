<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim ();

require '../utils/Util.php';
require '../utils/DB.php';
// POST route
$app->post ( '/', function () {
    $url = "http://localhost/myedu_rest/index.php/school/" + $_POST["school_id"];
    $courseList = Util::callApiWithGet($url);
    $select_sql = "select count(*) from myedu_course where id=:id";
    $insert_sql = "insert into myedu_course (course_number, course_name, professor, course_time school_id, dept_id, id) value (:course_number, :course_name, :professor, :course_time :school_id, :dept_id, :id)";
    $update_sql = "update myedu_course set course_number=:course_number, course_name=:course_name, professor=:professor, course_time=:course_time, school_id=:school_id, dept_id=:dept_id where id=:id";
    try{
        $conn = DB::getConnect();
        foreach ($courseList as $course){
            $id = $course["course_id"] + "_" + $course["school_id"] + "_" + $course["dept_id"];
            $stmt = $conn->prepare($select_sql);
            $stmt->bindParam(":id",$id);
            $stmt.execute();
            $rowcount = $stmt->rowCount();
            if($rowcount == 0){
                // add
                $stmt = $conn->prepare($insert_sql);
                $stmt->bindParam("course_number",$course['course_number']);
                $stmt->bindParam("course_name",$course['course_name']);
                $stmt->bindParam("professor",$course['professor']);
                $stmt->bindParam("course_time",$course['course_time']);
                $stmt->bindParam("school_id",$course['school_id']);
                $stmt->bindParam("dept_id",$course['dept_id']);
                $stmt->bindParam("id",$id);
                $stmt->execute();
                $conn = null;
            }else{
                //update
                $stmt = $conn->prepare($update_sql);
                $stmt->bindParam("course_number",$course['course_number']);
                $stmt->bindParam("course_name",$course['course_name']);
                $stmt->bindParam("professor",$course['professor']);
                $stmt->bindParam("course_time",$course['course_time']);
                $stmt->bindParam("school_id",$course['school_id']);
                $stmt->bindParam("dept_id",$course['dept_id']);
                $stmt->bindParam("id",$id);
                $stmt->execute();
                $conn = null;
            }
        }
    }catch(PDOException $e){
        echo '{"err":'.$e->getMessage().'}';
    }
    
} );

    
$app->run ();