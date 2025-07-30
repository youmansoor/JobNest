<?php
include 'config.php';

$table = $conn->prepare("select * from users");
$table->execute();
$result = $table->fetchall();
?>