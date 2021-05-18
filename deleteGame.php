<?php 
try{
    require 'inc/functions.php';
    $conn = opendb();

    $gameId = filter_input(INPUT_GET, 'gameId', FILTER_SANITIZE_NUMBER_INT);

    $delete = $conn->prepare("DELETE FROM game where id=:gameId");
    $delete->bindValue(":gameId", $gameId, PDO::PARAM_INT); 
    $delete->execute();

    header("Location: index.php");

}catch(PDOException $e){
    returnError($e);
}