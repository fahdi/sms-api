<?php
require __DIR__ . '/../vendor/autoload.php'; // Loads the library

use Twilio\Rest\Client;

// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Main/ Home route generic '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/send-sms', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/send-sms' route");
    // read phone number, message content, client ID

    $data = json_decode($request->getBody());

    $phoneNumber = $data->phone;
    $message = $data->message;
    $clientID = $data->client;

    // check if client is valid

    if (clientValid($clientID)) {
        $result = sendSMS($phoneNumber, $message);
        return $response->withJson( $result , 201);
        // respond with remaining count, success, and msg
    }

    $data = array('success' => false, 'msg' => 'Message wasn\'t sent. ');
    return $response->withJson($data, 404);
});

function sendSMS($phoneNumber, $message)
{
    if (twilioSend($phoneNumber, $message)) {
        $sent = 10;
        $remainingMessageCount = 1000 - $sent;
        $status = true;
        return array('remainingMessageCount' => $remainingMessageCount, 'success' => $status, 'msg' => 'Message sent.');
    }
    return array('remainingMessageCount' => NULL, 'success' => false, 'msg' => 'Message wasn\'t sent.');
}

function clientValid($ID)
{
    if ($ID === '9765487') {
        return true;
    }
    return false;
}

function twilioSend($phoneNumber, $message)
{

    require __DIR__ . '/../config/index.php'; // Loads the config

    $client = new Client($sid, $token);

    $client->messages->create(
    // the number you'd like to send the message to
    //'+923349529394', // Fahad
    //'+923429855439', // Tahir
    //'+923135809761', // Taufeeq
        $phoneNumber,
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => $mainPhoneNumber,
            // the body of the text message you'd like to send
            'body' => $message
        )
    );

    return true;
}
