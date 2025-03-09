<?php
$host = 'db.be-mons1.wasmer.network';
$dbname = 'bERjzFXnzSLqZaxB6naVoDa';
$username = 'ddcaf4bf79148000afcd018685d0';
$password = '067cddca-f4bf-7b8f-8000-95b43ae15a63';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?> 
