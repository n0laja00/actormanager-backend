<?php
    function opendb() {
    
        $server= "localhost";
        $username="root";
        $password = "";
        $db = "actormanager";
    
        $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; 
    };
    
    function returnError(PDOException $pdoex) {
        echo header('http/1.1 500 Internal Server Error');
        $error = array('error' => $pdoex->getMessage());
        echo json_encode($error);
        exit;
    };

    function jsonFactory(object $conn, string $sql): void {
        $query = $conn->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        header('http/1.1 200 OK');
        echo json_encode($results, JSON_PRETTY_PRINT); 
    }