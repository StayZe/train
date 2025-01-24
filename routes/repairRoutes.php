<?php
require_once 'controllers/RepairController.php';

function handleRepairRoutes($method, $uri)
{
    $parts = explode('/', trim($uri, '/'));

    if ($method === 'GET' && count($parts) === 1) {
        RepairController::index();
    } elseif ($method === 'POST') {
        RepairController::store();
    } elseif ($method === 'DELETE' && count($parts) === 2) {
        RepairController::destroy($parts[1]);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}
