<?php
class Database
{
    private static $pdo;

    public static function connect()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'pgsql:host=dpg-cu9pj9dumphs73cff3b0-a.frankfurt-postgres.render.com;dbname=train_1rb9',
                'train_1rb9_user',
                'hCsnwV6f7q3tix8hNKSRiUoYNmyDOxk9',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$pdo;
    }
}
