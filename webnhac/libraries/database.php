<?php

$hostname = "localhost";
$username = "root";
$password = "164584125";
$dbname = "web_nhac";
$conn = null;
// Ham ket noi
$conn = mysqli_connect($hostname, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function db_insert($table, $data = array()) {
    global $conn;
    $fields = '';
    $values = '';
    
    foreach($data as $field => $value) {
        $fields .= $field . ',';
        $values .= "'".addslashes($value)."',";
    }
    
    $fields = trim($fields, ',');
    $values = trim($values, ',');
    
    $sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
    
    return mysqli_query($conn, $sql);
}