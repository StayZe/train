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

        // Récupérer l'ID du type de réparation depuis repair_types
        $stmt = $db->prepare("SELECT id FROM repair_types WHERE name = ?");
        $stmt->execute([$repairType]);
        $repairTypeId = $stmt->fetchColumn();

        if (!$repairTypeId) {
            return ['error' => 'Repair type not found'];
        }

        // Insérer la réparation avec le bon repair_type_id
        $stmt = $db->prepare("INSERT INTO repairs (train_id, repair_type_id) VALUES (?, ?) RETURNING id");
        $stmt->execute([$trainId, $repairTypeId]);

        return ['id' => $stmt->fetchColumn(), 'train_id' => $trainId, 'type' => $repairType];
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM repairs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
