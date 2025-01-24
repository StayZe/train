<?php
require_once 'Database.php';

class Repair
{
    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM repairs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($trainId, $repairType)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO repairs (train_id, type) VALUES (?, ?) RETURNING id");
        $stmt->execute([$trainId, $repairType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM repairs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
