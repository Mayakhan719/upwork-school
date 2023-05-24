<?php

session_start();
// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
$data = new stdClass();
$data->conn=connect();
if($_SERVER['REQUEST_METHOD'] === "POST"){
if(!empty($_POST["email"]) && !empty($_POST["password"])){
$data->email=$_POST["email"];
 $data->password=$_POST["password"];
 if(!empty($row=searchByEmail($data))){
 $passwordFetch = $row["password"];
if (password_verify($data->password,$passwordFetch)) {
    
    $_SESSION["admin_email"]=$data->email;
    $_SESSION["admin_id"]=$row["id"];
    header("location:../../index.php");
}else{
    $_SESSION["message_error"]="Incorrect Password";
    header("location:../../login.php");
}
 }else{
    $_SESSION["message_error"]="Email Not Register";
    header("location:../../login.php");
}
}else{
    $_SESSION["message_error"]="Email and Password Are required";
    header("location:../../login.php");
}
}else{
    $_SESSION["message_error"]="Server Error";
    header("location:../../login.php");
}
?>