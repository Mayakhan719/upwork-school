<?php
session_start();
// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");

$data = new stdClass();
$data->conn=connect();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST["password"]) && isset($_POST["new-password"]) && isset($_POST["confirm-password"])) {
        $data->email=$_SESSION["admin_email"];
        $password=$_POST["password"];
        $newPassword=$_POST["new-password"];
        $conformPassword=$_POST["confirm-password"];
    if ($newPassword == $conformPassword) {
        $data->password=password_hash($conformPassword, PASSWORD_DEFAULT);
        if(!empty($row=searchByEmail($data))){
            $fetchPassword= $row["password"];
            if (password_verify($password,$fetchPassword)) {
                if(resetPassword($data)){
                    $_SESSION["message"]="Password Updated Successfully";
                    header("location:../../profile.php");
                    }else{
                        $_SESSION["message_error"]="Failed to update password ";
                        header("location:../../profile.php");
                    }
                }else{
                    $_SESSION["message_error"]="Password Incorrect";
                    header("location:../../profile.php");
                }
            }else{
                $_SESSION["message_error"]="user not found";
                header("location:../../profile.php?USER=$data->email");
            }
    
        }else{
            $_SESSION["message_error"]="new Password and confirm password are not same";
            header("location:../../profile.php");
        }


}else{
    $_SESSION["message_error"]="All Data Needed";
    header("location:../../profile.php");
    }
}else{
    http_response_code(500);
    echo json_encode(array(
    "status"=>false,
    "message"=>"server error"
));
    }
?>