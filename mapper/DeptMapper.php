<?php
require_once '../utils/DB.php';

class DeptMapper{
    public static function selectDeptListBySchoolId($school_id){
        $sql = "select * from dept where school_id=:id";
        try {
            $conn = DB::getConnect ();
            $stmt = $conn->prepare ( $sql );
            $stmt->bindParam ( "id", $school_id );
            $stmt->execute ();
            $data = $stmt->fetchAll ( PDO::FETCH_ASSOC );
            $conn = null;
            return $data;
        } catch ( PDOException $e ) {
            echo '{"error":' . $e->getMessage () . '}';
        }
    }
}