<?php

class DB
{
    const HOST = "localhost";
    const DBNAME = "ulovdomov";
    const USERNAME = "root";
    const PASSWORD = "root";

    private static $connection;


    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (isset(self::$connection)) {
            return self::$connection;
        }
        return self::$connection = self::buildConnection();
    }


    /**
     * @return PDO
     */
    private static function buildConnection(): PDO
    {
        $dsn = "mysql:dbname=" . self::DBNAME . ";host=" . self::HOST . ";charset=utf8";
        $user = self::USERNAME;
        $password = self::PASSWORD;

        try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: {$e->getMessage()}");
        }
    }

}