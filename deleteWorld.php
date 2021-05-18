<?php
require 'inc/functions.php';
try{
    
    $conn=opendb();
    $worldId = filter_input(INPUT_GET, 'worldId', FILTER_SANITIZE_NUMBER_INT);
    $delete = $conn->prepare("DELETE FROM world where worldId=:worldId");
    $delete->bindValue(":worldId", $worldId, PDO::PARAM_INT);
    $delete->execute();

    header("Location: selectGame.php");
} catch(PDOException $e){
    returnError($e);
};