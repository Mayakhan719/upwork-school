<?php
// file include
include_once("../../../include/db.php");

// object
$connection=connect();

if (isset($_POST["id"])) {
    # code...
$id = $_POST["id"];
$query = "SELECT * FROM promo_codes WHERE id=$id";
$result = pg_query($connection, $query);
$row = pg_fetch_object ($result);

   
// Important to echo the record in JSON format
echo json_encode($row);

// Important to stop further executing the script on AJAX by following line
exit();

}else{
    echo json_encode("error");
    exit();
}
?>