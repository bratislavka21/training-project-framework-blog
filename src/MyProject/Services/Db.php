<?php


namespace MyProject\Services;


class Db
{
    private $pdo;

    public function __construct()
    {
        $dbOptions = require_once __DIR__ . '/../../settings.php';
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbName'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec("SET NAMES UTF8");
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
