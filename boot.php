<?php

require "vendor/autoload.php";


$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'hbwchr26dkb3f6kx',
    'publicKey' => 'gt3hytxmkhhwrsx6',
    'privateKey' => '3305786dde515a45b8711acadf46d8a0'
]);

?>