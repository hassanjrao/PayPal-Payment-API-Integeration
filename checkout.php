<?php
require_once("boot.php");

$name = $_POST["name"];
$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];


$result = $gateway->transaction()->sale([
    'amount' => $amount,
    'paymentMethodNonce' => $nonce,
    'options' => [
        'submitForSettlement' => true
    ]
]);

if ($result->success || !is_null($result->transaction)) {
    $transaction = $result->transaction;
    header("Location: " . "transaction.php?id=$transaction->id & name=$name");
} else {
    $errorString = "";

    foreach ($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }

    $_SESSION["errors"] = $errorString;
    header("Location: index.php");
}
