<?php
require_once '../utils/DB.php';
class CourseMapper {
    /**
     * 
     * @param  $courseList 
     */
    public static function saveOrUpdate($courseList) {
        $select_sql = "select * from myedu_course where id=:id";
        $insert_sql = "insert into myedu_course (course_number, course_name, professor, course_time, school_id, dept_id, id) values (:course_number, :course_name, :professor, :course_time, :school_id, :dept_id, :id)";
        $update_sql = "update myedu_course set course_number=:course_number, course_name=:course_name, professor=:professor, course_time=:course_time, school_id=:school_id, dept_id=:dept_id where id=:id";
        try {
            $conn = DB::getConnect ();
            foreach ( $courseList as $course ) {
                $id = $course ["course_id"] . "_" . $course ["school_id"] . "_" . $course ["dept_id"];
                $stmt = $conn->prepare ( $select_sql );
                $stmt->bindParam ( "id", $id );
                $stmt->execute ();
                $rowcount = $stmt->rowCount ();
                if ($rowcount == 0) {
                    // add
                    $stmt = $conn->prepare ( $insert_sql );
                    CourseMapper::bindData ( $stmt, $course, $id );
                    $stmt->execute ();
                } else {
                    // update
                    $stmt = $conn->prepare ( $update_sql );
                    CourseMapper::bindData ( $stmt, $course, $id );
                    $stmt->execute ();
                }
            }
            $conn = null;
            return '{"status":"success"}';
        } catch ( PDOException $e ) {
            return '{"status":' . $e->getMessage () . '}';
        }
    }
    
    /**
     * 
     * @param  $stmt
     * @param  $course
     */
    private static function bindData($stmt, $course, $id) {
        $stmt->bindParam ( "course_number", $course ['course_number'] );
        $stmt->bindParam ( "course_name", $course ['course_name'] );
        $stmt->bindParam ( "professor", $course ['professor'] );
        $stmt->bindParam ( "course_time", $course ['course_time'] );
        $stmt->bindParam ( "school_id", $course ['school_id'] );
        $stmt->bindParam ( "dept_id", $course ['dept_id'] );
        $stmt->bindParam ( "id", $id );
    }
    
    /**
     *
     * @param
     *            $school_id
     * @return
     *
     */
    public static function selectCourseByParam($school_id, $dept_id) {
      //  $sql = "select * from school_course where school_id=:id";
        $sql = "select c.course_number, c.course_name, c.professor, c.course_time, d.dept_name, d.dept_name_abbrev from myedu_course c left join dept d on c.dept_id = d.dept_id where c.school_id=:school_id and c.dept_id=:dept_id";
        try {
            $conn = DB::getConnect ();
            $stmt = $conn->prepare ( $sql );
            $stmt->bindParam ( "school_id", $school_id );
            $stmt->bindParam ( "dept_id", $dept_id );
            $stmt->execute ();
            $row = $stmt->fetchAll ( PDO::FETCH_ASSOC );
            $conn = null;
            return $row;
        } catch ( PDOException $e ) {
            return array (
                    "status" => $e->getMessage ()
            );
        }
    }
}