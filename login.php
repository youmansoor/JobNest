<?php
include 'config.php';

if(isset($_GET['login'])){
    $name = $_GET['Username'];
    $pass = $_GET['Password'];
    $get = $conn->prepare("select * from users where Username='$name' AND Password='$pass'");
    $get->execute();
    $data = $get->fetchall();

    if($data){
        echo "Correct";
        exit;
    }

    $get = $conn->prepare("select * from empolyee where Username='$name' AND Password='$pass'");
    $get->execute();
    $data = $get->fetchall();

    if($data){
        echo "Correct";
        exit;
    }
    echo "Wrong Username or Password"; 
}
?>