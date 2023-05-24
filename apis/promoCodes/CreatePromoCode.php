<?php

ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

require_once('../../libraries/strip/vendor/autoload.php');
include_once("../function/Function.php");
include_once("../../include/db.php");
$data = new stdClass();
$data->conn=connect();
// Set your Stripe API keys
$PublishableKey = "pk_test_51Mtnu0C2CkXRGRDYPH2VTIyCdq3V1T6l7Tex8G5sXHKbz8B09u818cTeV8oWxC2SeuZLaDdb4yhFqfVEbzti0UpW00BnqrEaJb";
$SecretKey = "sk_test_51Mtnu0C2CkXRGRDYy9HS0UgWqBjMzbrw1gWxfLiNpwi5H3KL5r04vLPdmx1QLuZ3brzBOYv95Y8s0CXzI1Hw42gV00006ruSmB";

\Stripe\Stripe::setApiKey($SecretKey);

// Create a new customer
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data2 = json_decode(file_get_contents("php://input"));
    try {
        // create a new coupon
        $coupon = \Stripe\Coupon::create([
            'percent_off' => $data2->discount,
            'duration' => 'forever',
            'redeem_by' => strtotime($data2->expire_date), // convert the date to a timestamp
            'name' => $data2->name,
        ]);
        $data->code = $coupon->id;
        $data->discount = $data2->discount;
        $date_str =  $data2->expire_date;
        $timestamp = strtotime($date_str);
        $data->expire_date = date('Y-m-d', $timestamp);
        if (CreatePromoCode($data)) {
            echo json_encode(array(
                "Status"=>true,
                "message"=>"Promo code created successfully",
                "coupon_id"=>$coupon
            ));
        }
        
    } catch (\Stripe\Exception\CardException $e) {
        echo json_encode(['error' => $e->getError()->message]);
    }
};


?>
