<?php
session_start();
// file include
include_once("../../../include/db.php");
include_once("../../function/Admin.php");
$data = new stdClass();
$data->conn=connect();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["link"])) {
    if (!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["link"])) {
    $data->link=$_POST["link"];
    $data->description=$_POST["description"];
    $data->title=$_POST["title"];
$youtubeLinkPattern = "/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=)?([a-zA-Z0-9_-]{11})/";
// Check if the link matches the pattern
if (preg_match($youtubeLinkPattern, $data->link, $matches)) {
        if (createVideo($data)) {
            $_SESSION["message"] = "Video Created Successfully";
            header("location:../../videos.php");
        }else{
            $_SESSION["message_error"] = "failed to create video";
            header("location:../../videos.php");
        }
    }else {
            $_SESSION["message_error"] = "link is not valid";
            header("location:../../videos.php");
    }
    }else {
        $_SESSION["message_error"] = "All Data Needed";
            header("location:../../videos.php");
    }
    }else{
        $_SESSION["message_error"] = "All data needed";
        header("location:../../videos.php");
    }
}else{
    $_SESSION["message_error"] = "Server error";
    header("location:../../videos.php");
    }
?>