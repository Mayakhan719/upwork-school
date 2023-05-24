<?php
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type:application/json; charst= UTF-8");
// file include
include_once("../../../include/db.php");
$data = new stdClass();
$conn=connect();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data2 = json_decode(file_get_contents("php://input"));
    $bid_id = $_POST["data"];
    if (!empty($bid_id)) {
        if ($bid_id == "year") {

            $time = strtotime(date(("Y-m-d")));
            $now = date("Y", strtotime("0 day", $time));
            $next = date("Y", strtotime("+1 year", $time));
            $oneMonth = date("Y", strtotime("-1 year", $time));
            $twoMonth = date("Y", strtotime("-2 year", $time));
            $thrMonth = date("Y", strtotime("-3 year", $time));
            $fouMonth = date("Y", strtotime("-4 year", $time));
            $fivMonth = date("Y", strtotime("-5 year", $time));
            $sixMonth = date("Y", strtotime("-6 year", $time));
            $sevMonth = date("Y", strtotime("-7 year", $time));
            $eigMonth = date("Y", strtotime("-8 year", $time));
            $ninMonth = date("Y", strtotime("-9 year", $time));
            $tenMonth = date("Y", strtotime("-10 year", $time));
            $eleMonth = date("Y", strtotime("-11 year", $time));

            $one = 0;
            $two = 0;
            $three = 0;
            $four = 0;
            $five = 0;
            $six = 0;
            $seven = 0;
            $eight = 0;
            $nine = 0;
            $ten = 0;
            $eleven = 0;
            $twl = 0;

$sql = "SELECT * FROM users";
  $run = pg_query($conn,$sql);
  while($users = pg_fetch_assoc($run)){
    $created_at = $users["created_at"];
    $end_time4 = date("M-Y", strtotime($created_at));
  
    if ($created_at == $now) {
      $one++;
    }elseif ($created_at == $twoMonth) {
      $two++;
    }elseif ($created_at == $thrMonth) {
      $three++;
    }elseif ($created_at == $fouMonth) {
      $four++;
    }elseif ($created_at == $fivMonth) {
      $five++;
    }elseif ($created_at == $sixMonth) {
      $six++;
    }elseif ($created_at == $sevMonth) {
      $seven++;
    }elseif ($created_at == $eigMonth) {
      $eight++;
    }elseif ($created_at == $ninMonth) {
      $nine++;
    }elseif ($created_at == $tenMonth) {
      $ten++;
    }elseif ($created_at == $eleMonth) {
      $eleven++;
    }else {
      $twl++;
    }
  }
  $array = array(
    $two,
    $three,
    $four,
    $five,
    $six,
    $seven,
    $eight,
    $nine,
    $ten,
    $eleven,
    $twl,
);
  $array2 = array(
$eleMonth ,
$tenMonth ,
$ninMonth ,
$eigMonth ,
$sevMonth ,
$fivMonth ,
$fouMonth ,
$thrMonth ,
$twoMonth ,
$oneMonth, 
$now 
);
        http_response_code(200);
        echo json_encode(array(
        "status"=>true,
        "filter"=>$bid_id,
        "data"=>$array,
        "days"=>$array2
    ));
        }elseif ($bid_id == "weeks") {
           
            $time = strtotime(date(("Y-m-d")));
            $now = date("Y-m-d", strtotime("0 day", $time));
            $next = date("Y-m-d", strtotime("+1 day", $time));
            $oneMonth = date("Y-m-d", strtotime("-1 day", $time));
            $twoMonth = date("Y-m-d", strtotime("-2 day", $time));
            $thrMonth = date("Y-m-d", strtotime("-3 day", $time));
            $fouMonth = date("Y-m-d", strtotime("-4 day", $time));
            $fivMonth = date("Y-m-d", strtotime("-5 day", $time));
            $sixMonth = date("Y-m-d", strtotime("-6 day", $time));
            $sevMonth = date("Y-m-d", strtotime("-7 day", $time));
            $eigMonth = date("Y-m-d", strtotime("-8 day", $time));
            $ninMonth = date("Y-m-d", strtotime("-9 day", $time));
            $tenMonth = date("Y-m-d", strtotime("-10 day", $time));
            $eleMonth = date("Y-m-d", strtotime("-11 day", $time));

            $one = 0;
            $two = 0;
            $three = 0;
            $four = 0;
            $five = 0;
            $six = 0;
            $seven = 0;
            $eight = 0;
            $nine = 0;
            $ten = 0;
            $eleven = 0;
            $twl = 0;

$sql = "SELECT * FROM users";
  $run = pg_query($conn,$sql);
  while($users = pg_fetch_assoc($run)){
    $created_at = $users["created_at"];
    $end_time4 = date("Y-m-d", strtotime($created_at));
  
    
    if ($created_at == $now) {
        $one++;
      }elseif ($created_at == $twoMonth) {
        $two++;
      }elseif ($created_at == $thrMonth) {
        $three++;
      }elseif ($created_at == $fouMonth) {
        $four++;
      }elseif ($created_at == $fivMonth) {
        $five++;
      }elseif ($created_at == $sixMonth) {
        $six++;
      }elseif ($created_at == $sevMonth) {
        $seven++;
      }elseif ($created_at == $eigMonth) {
        $eight++;
      }elseif ($created_at == $ninMonth) {
        $nine++;
      }elseif ($created_at == $tenMonth) {
        $ten++;
      }elseif ($created_at == $eleMonth) {
        $eleven++;
      }else {
        $twl++;
      }
    }
    $array = array(
      $five,
      $six,
      $seven,
      $eight,
      $nine,
      $ten,
      $eleven,
      $twl,
  );
$array2 = array(
  $eigMonth ,
  $sevMonth ,
  $fivMonth ,
  $fouMonth ,
  $thrMonth ,
  $twoMonth ,
  $oneMonth, 
  $now 
  );
        http_response_code(200);
        echo json_encode(array(
        "status"=>true,
        "filter"=>$bid_id,
        "data"=>$array,
        "days"=>$array2
    ));
        }elseif ($bid_id == "month") {
            $time = strtotime(date(("Y-m-d")));
            $now = date("M-Y", strtotime("0 day", $time));
            $next = date("M-Y", strtotime("+1 month", $time));
            $oneMonth = date("M-Y", strtotime("-1 month", $time));
            $twoMonth = date("M-Y", strtotime("-2 month", $time));
            $thrMonth = date("M-Y", strtotime("-3 month", $time));
            $fouMonth = date("M-Y", strtotime("-4 month", $time));
            $fivMonth = date("M-Y", strtotime("-5 month", $time));
            $sixMonth = date("M-Y", strtotime("-6 month", $time));
            $sevMonth = date("M-Y", strtotime("-7 month", $time));
            $eigMonth = date("M-Y", strtotime("-8 month", $time));
            $ninMonth = date("M-Y", strtotime("-9 month", $time));
            $tenMonth = date("M-Y", strtotime("-10 month", $time));
            $eleMonth = date("M-Y", strtotime("-11 month", $time));
            $one = 0;
            $two = 0;
            $three = 0;
            $four = 0;
            $five = 0;
            $six = 0;
            $seven = 0;
            $eight = 0;
            $nine = 0;
            $ten = 0;
            $eleven = 0;
            $twl = 0;
            $sql = "SELECT * FROM users";
            $run = pg_query($conn,$sql);
            while($users = pg_fetch_assoc($run)){
              $created_at = $users["created_at"];
              $end_time4 = date("M-Y", strtotime($created_at));
            
              if ($created_at == $now) {
                $one++;
              }elseif ($created_at == $twoMonth) {
                $two++;
              }elseif ($created_at == $thrMonth) {
                $three++;
              }elseif ($created_at == $fouMonth) {
                $four++;
              }elseif ($created_at == $fivMonth) {
                $five++;
              }elseif ($created_at == $sixMonth) {
                $six++;
              }elseif ($created_at == $sevMonth) {
                $seven++;
              }elseif ($created_at == $eigMonth) {
                $eight++;
              }elseif ($created_at == $ninMonth) {
                $nine++;
              }elseif ($created_at == $tenMonth) {
                $ten++;
              }elseif ($created_at == $eleMonth) {
                $eleven++;
              }else {
                $twl++;
              }
            }
            $array = array(
                $two,
                $three,
                $four,
                $five,
                $six,
                $seven,
                $eight,
                $nine,
                $ten,
                $eleven,
                $twl,
            );
              $array2 = array(
            $eleMonth ,
            $tenMonth ,
            $ninMonth ,
            $eigMonth ,
            $sevMonth ,
            $fivMonth ,
            $fouMonth ,
            $thrMonth ,
            $twoMonth ,
            $oneMonth, 
            $now 
            );
                  http_response_code(200);
                  echo json_encode(array(
                  "status"=>true,
                  "filter"=>$bid_id,
                  "data"=>$array,
                  "days"=>$array2
              ));
        }
    }else {
        http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"All Data Needed"
));
    }
}else{
    http_response_code(200);
    echo json_encode(array(
    "status"=>false,
    "message"=>"Server error"
));
}
           
?>