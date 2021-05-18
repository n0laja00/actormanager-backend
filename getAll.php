<?php
require_once 'inc/headers.php';
try{
    require 'inc/functions.php';
    $conn=opendb();
    $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
    jsonFactory($conn, "select * from ".$type);
}catch(PDOException $pdoex){
    returnError($pdoex);
};
