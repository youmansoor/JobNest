<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jobnest';

$conn = new PDO("mysql: host=$host; dbname=$dbname", $username, $password);
$conn->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($conn){
    // echo "Connected";
}
?>