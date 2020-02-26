<?php


namespace MyProject\Services;


class Db
{
    private static $instance;

    private $pdo;

    private function __construct()
    {
        $dbOptions = require __DIR__ . '/../../settings.php';
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbName'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec("SET NAMES UTF8");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $sql, array $queryPlaceholders = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($queryPlaceholders);

        if ($result === false) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
