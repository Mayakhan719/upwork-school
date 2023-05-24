<?php

ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");
// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
$data2 = new stdClass();
$data2->conn=connect();
require_once('../../libraries/strip/vendor/autoload.php');

// Set your Stripe API keys
$PublishableKey = "pk_test_51Mtnu0C2CkXRGRDYPH2VTIyCdq3V1T6l7Tex8G5sXHKbz8B09u818cTeV8oWxC2SeuZLaDdb4yhFqfVEbzti0UpW00BnqrEaJb";
$SecretKey = "sk_test_51Mtnu0C2CkXRGRDYy9HS0UgWqBjMzbrw1gWxfLiNpwi5H3KL5r04vLPdmx1QLuZ3brzBOYv95Y8s0CXzI1Hw42gV00006ruSmB";

\Stripe\Stripe::setApiKey($SecretKey);

// Create a new customer
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    try {
        $paymentMethod = \Stripe\PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number' => $data->card_number,
                'exp_month' => $data->card_exp_month,
                'exp_year' => $data->card_exp_year,
                'cvc' => $data->card_cvv,
            ]
        ]);
         // Create a new customer
         $customer = \Stripe\Customer::create([
            'email' => $data->email,
            'name' => $data->name,
            'phone' => $data->phone,
            'description' => $data->description,
            'payment_method' => $paymentMethod->id
        ]);
        // Create a new subscription
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $data->amount,
            'currency' => $data->currency,
            'payment_method' => $paymentMethod->id, // ID of the payment method to use
            'confirm' => true,
            'customer'=>$customer->id
        ]);
        $ephemeralKey = \Stripe\EphemeralKey::create([
            'customer' => $customer->id,
        ], [
          'stripe_version' => '2022-08-01',
        ]);
        $data2->user_id = $data->user_id;
        $data2->customer_id = $customer->id;
        $data2->client_secret = $payment_intent->client_secret;
        $data2->secret = $ephemeralKey->secret;
        $data2->amount = $data->amount*100;
        $data2->currency = $data->currency;
        if (createSUbscription($data2)) {
            echo json_encode(array(
                "Status"=>true,
                "message"=>"subscription created successfully",
                "customer"=>$customer->id,
                "payment_intent_client_secret"=>$payment_intent->client_secret,
                "ephemeral_secret_Key"=>$ephemeralKey->secret,
                "publishableKey"=>$PublishableKey
            ));
        }
    } catch (\Stripe\Exception\CardException $e) {
        echo json_encode(['error' => $e->getError()->message]);
    }
};


?>
