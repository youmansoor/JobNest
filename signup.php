<?php
include 'config.php';

if($_POST['role'] === 'user'){
    if(isset($_POST['role'])){
        $role = $_POST['role'];
        $name = $_POST['Username'];
        $pass = $_POST['Password'];

        $conn->query("INSERT INTO users (Username, Password) VALUES ('$name','$pass')");

        if($conn){
            echo "Data Insertd";
        }
    }
}
if($_POST['role'] === 'employee'){
    if(isset($_POST['role'])){
        $role = $_POST['role'];
        $name = $_POST['Username'];
        $pass = $_POST['Password'];

        $conn->query("INSERT INTO empolyee (Username, Password) VALUES ('$name','$pass')");

        if($conn){
            echo "Data Insertd";
        }
    }
}
?>