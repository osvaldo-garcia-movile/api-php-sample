<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$phone = '5512345678';
$text = 'Mensaje de prueba';

$dataRequest = [
    'messages' => [
        ['destination' => strlen($phone) == 10?'52' . $phone:$phone,
            'messageText' => $text]
    ]
];

$user = getenv('API_USER');
$token = getenv('API_TOKEN');

$client = new \GuzzleHttp\Client();
echo json_encode($dataRequest) . "\n";

$response = $client->request('POST', 'https://api-messaging.movile.com/v1/send-bulk-sms', [
    'headers' => [
        'authenticationtoken' => $token,
        'username' => $user
    ],
    'json' => $dataRequest
]);

echo $response->getBody()->getContents() . "\n\n";
