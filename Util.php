<?php
class Util {
    public static function callApiWithGet($apiUrl, $isArray = true) {
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $apiUrl );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec ( $ch );
        if ($output === FALSE) {
            echo "cURL Error: " . curl_error ( $ch );
        }
        curl_close ( $ch );
        if ($isArray) {
            return json_decode ( $output, true );
        } else {
            return $output;
        }
    }
}