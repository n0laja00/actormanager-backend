<?php
try{
    require 'inc/functions.php';
    require 'inc/headers.php';

    $input = json_decode(file_get_contents('php://input'));
    $conn=opendb();
    $conn->beginTransaction();
    $type = $input->type;
    $id = $input->id;

    $stmt = $conn -> prepare("DELETE FROM ".$type." where id = :id"); 
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $conn->commit();

    header('HTTP/1.1 200 OK');
    $data = array('win');
    echo json_encode($data);
    

}catch(PDOException $pdoex){
    $conn->rollBack();
    returnError($pdoex);
};