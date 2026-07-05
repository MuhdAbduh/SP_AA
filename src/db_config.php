<?php

$host = "localhost";
$dbname = "medic_vault_db";
$username = "root";
$password = "";

$conn = new PDO(
    "mysql:host=$host;dbname=$dbname",
    $username,
    $password
);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);