<?php

    $host = 'localhost';
    $dbname = 'todo';
    $username = 'root';
    $password = '93909311';

    try {
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        die('Error!: ' . $e->getMessage());

    }

