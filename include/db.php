<?php
function connect(){
  $appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $connStr = "host=postgres-node-staging-projects.mtechub.com port=5432 dbname=upworkschool user=upworkschooluser password=mtechub123";
  
  $conn = pg_connect($connStr);
  if ($conn) {
      # code...
      // echo "connection established";
      return $conn;
  }
  }

 ?>
