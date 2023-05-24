<?php

ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

require_once('../../libraries/strip/vendor/autoload.php');

// Set your Stripe API keys
$PublishableKey = "pk_test_51Mtnu0C2CkXRGRDYPH2VTIyCdq3V1T6l7Tex8G5sXHKbz8B09u818cTeV8oWxC2SeuZLaDdb4yhFqfVEbzti0UpW00BnqrEaJb";
$SecretKey = "sk_test_51Mtnu0C2CkXRGRDYy9HS0UgWqBjMzbrw1gWxfLiNpwi5H3KL5r04vLPdmx1QLuZ3brzBOYv95Y8s0CXzI1Hw42gV00006ruSmB";

\Stripe\Stripe::setApiKey($SecretKey);

// Create a new customer
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $body = json_decode(file_get_contents("php://input"));
    try {
        $price = \Stripe\Price::create([
            'product' => $body->product_id,
            'unit_amount' => $body->price * 100, // price in cents
            'currency' => $body->currency,
        ]);
        echo json_encode(array(
            "Status"=>true,
            "message"=>"price created successfully",
            "price"=>$price
        ));
    } catch (\Stripe\Exception\CardException $e) {
        echo json_encode(['error' => $e->getError()->message]);
    }
};


?>
