<?php
try{
    require 'inc/functions.php';
    require 'inc/headers.php';
    $input = json_decode(file_get_contents('php://input'));
    $conn=opendb();
    $conn->beginTransaction();
    $type = filter_var($input->type, FILTER_SANITIZE_STRING);
    $name = filter_var($input->name, FILTER_SANITIZE_STRING);
    $ruleSet = filter_var($input->ruleSet, FILTER_SANITIZE_STRING);
    $description = filter_var($input->description, FILTER_SANITIZE_STRING);

    if($type==="game") {
        $stmt = $conn -> prepare("INSERT INTO game (name, ruleSet, description) values (:name, :ruleSet, :description)"); 
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":ruleSet", $ruleSet, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->execute();

        $conn->commit();

        header('HTTP/1.1 200 OK');
        $data = array('Tilaus tehty');
        echo json_encode($data);
        
    } else {
        $stmt = $conn -> prepare("INSERT INTO ".$type." (name, description, gameId) values (:name, :description, 1)");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->execute();
        $conn->commit();

        header('HTTP/1.1 200 OK');
        $data = array('Tilaus tehty');
        echo json_encode($data);
    }
    
}catch(PDOException $pdoex){
    $conn->rollBack();
    returnError($pdoex);
};