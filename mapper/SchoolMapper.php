<?php
require_once '../utils/DB.php';

class SchoolMapper{
    public static function selectAllSchools(){
        $sql = "select * from school";
        try {
            $conn = DB::getConnect ();
            $stmt = $conn->query ( $sql );
            $data = $stmt->fetchAll ( PDO::FETCH_ASSOC );
            $conn = null;
            return $data;
        } catch ( PDOException $e ) {
            echo '{"error":' . $e->getMessage () . '}';
        }
    }
}