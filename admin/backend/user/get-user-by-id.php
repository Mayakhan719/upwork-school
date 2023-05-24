<?php
// file include
include_once("../../../include/db.php");

// object
$connection=connect();

if (isset($_POST["id"])) {
    # code...
$id = $_POST["id"];
$query = "SELECT * FROM users WHERE id=$id";
$result = pg_query($connection, $query);
$row = pg_fetch_assoc ($result);
if (empty($row["status"])) {
    $status = "";
}else {
    $status=$row["status"];
}
$data = array(
"username" => $row["username"],
"email"=>$row["email"],
"status"=>$status
);
   
// Important to echo the record in JSON format
echo json_encode($data);

// Important to stop further executing the script on AJAX by following line
exit();

}else{
    echo json_encode("error");
    exit();
}
?>