<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Main/ HName route generic '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/send-sms', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/send-sms' route");

    $data = array('success' => 'true', 'msg' => 'Message sent.');
    return $response->withJson($data, 201);
});
