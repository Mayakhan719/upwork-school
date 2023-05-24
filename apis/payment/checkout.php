<?php

ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");
include_once("../../include/db.php");
include_once("../function/Function.php");
$data = new stdClass();
$data->conn=connect();
require_once('../../libraries/strip/vendor/autoload.php');
// Set your Stripe API keys
$PublishableKey = "pk_test_51Mtnu0C2CkXRGRDYPH2VTIyCdq3V1T6l7Tex8G5sXHKbz8B09u818cTeV8oWxC2SeuZLaDdb4yhFqfVEbzti0UpW00BnqrEaJb";
$SecretKey = "sk_test_51Mtnu0C2CkXRGRDYy9HS0UgWqBjMzbrw1gWxfLiNpwi5H3KL5r04vLPdmx1QLuZ3brzBOYv95Y8s0CXzI1Hw42gV00006ruSmB";
\Stripe\Stripe::setApiKey($SecretKey);
// Create a new customer
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $body = json_decode(file_get_contents("php://input"));
    try {
        $token = \Stripe\Token::create([
            'card' => [
              'number' => $body->card_number,
              'exp_month' => $body->card_exp_month,
              'exp_year' => $body->card_exp_year,
              'cvc' => $body->card_cvc,
            ],
          ]);
        $charge = \Stripe\Charge::create([
            'amount' => $body->amount*100,
            'currency' => $body->currency,
            'description' => $body->description,
            'source' => $token,
        ]);
        $data->token = $token;
        $data->user_id = $body->user_id;
        $data->amount =$body->amount;
        if (payament($data)) {
            echo json_encode(array(
                "Status"=>true,
                "message"=>"Payment succeeded",
                "receipt"=>$charge["receipt_url"],
                "token"=>$token,
            ));
        }
        
    } catch (\Stripe\Exception\CardException $e) {
        echo json_encode(['error' => $e->getError()->message]);
    }
};


?>
