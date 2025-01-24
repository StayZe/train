<?php
require_once 'models/Repair.php';

class RepairController
{
    public static function index()
    {
        echo json_encode(Repair::getAll());
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['train_id']) && isset($data['type'])) {
            echo json_encode(Repair::create($data['train_id'], $data['type']));
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
        }
    }

    public static function destroy($id)
    {
        if (Repair::delete($id)) {
            echo json_encode(['success' => 'Repair deleted']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Delete failed']);
        }
    }
}
