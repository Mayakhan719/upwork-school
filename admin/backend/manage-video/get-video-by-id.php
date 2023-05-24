<?php
// file include
include_once("../../../include/db.php");

// object
$connection=connect();

if (isset($_POST["id"])) {
    # code...
$id = $_POST["id"];
$query = "SELECT * FROM videos WHERE id=$id";
$result = pg_query($connection, $query);
$row = pg_fetch_assoc ($result);

   $id = $row["id"];
   $link = $row["link"];
   parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
   
   $vid = "https://www.youtube.com/embed/".$my_array_of_vars["v"];
   $url = '<img src=https://img.youtube.com/vi/'.$vid.'/0.jpg" alt="thumbnail">';
   $description = $row["description"];
   $title = $row["title"];
   $array = array(
    "id"=>$id,
    "title"=>$title,
    "link"=>$link,
    "description"=>$description,
    "thumbnail"=>$vid
   );
//    $id = $row["id"];
// Important to echo the record in JSON format
echo json_encode($array);

// Important to stop further executing the script on AJAX by following line
exit();

}else{
    echo json_encode("error");
    exit();
}
?>