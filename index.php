<?php
require_once 'routes/trainRoutes.php';
require_once 'routes/repairRoutes.php';

$requestUri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$requestMethod = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch (true) {
    case strpos($requestUri, '/trains') === 0:
        handleTrainRoutes($requestMethod, $requestUri);
        break;
    case strpos($requestUri, '/repairs') === 0:
        handleRepairRoutes($requestMethod, $requestUri);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
}
