<?php

    try {
        require 'inc/functions.php';
        $conn=opendb();
        $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $ruleSet=filter_input(INPUT_POST, 'ruleSet', FILTER_SANITIZE_STRING);
        $description=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        $save = $conn->prepare("INSERT INTO game (name, ruleSet, description) VALUES (:name, :ruleSet, :description)");
        $save->bindValue(":name", $name, PDO::PARAM_STR);
        $save->bindValue(":ruleSet", $ruleSet, PDO::PARAM_STR);
        $save->bindValue(":description", $description, PDO::PARAM_STR);
        $save->execute();

        $uusiId=$conn->lastInsertId();
        header("Location: index.php");

    } catch(PDOException $e) {
        returnError($e);
    }

    
