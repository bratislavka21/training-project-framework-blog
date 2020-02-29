<?php


namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    protected $id;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public function delete(): void
    {
        $sql = "DELETE FROM " . static::getTableName() . " WHERE `id` = :id";

        $placeholdersForQuery['id'] = $this->id;
        $db = Db::getInstance();
        $db->query($sql, $placeholdersForQuery);
        $this->id = null;
    }

    public static function findAll(): array
    {
        $db = Db::getInstance();

        return $db->query("SELECT * FROM " . static::getTableName(), [], static::class);
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();

        $result = $db->query(
            "SELECT * FROM " . static::getTableName() . " WHERE `id` = :id",
            ['id' => $id],
            static::class
        );
        
        return $result ? $result[0] : null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();

        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    abstract protected static function getTableName(): string;

    private function camelCaseToUnderscore(string $camelCaseName): string
    {
        return strtolower(preg_replace('~(?<!^)[A-Z]~', '_$0', $camelCaseName));
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $placeholdersForQuery = [];
        $paramsForSql = [];
        $fieldsForSql = [];

        foreach ($filteredProperties as $field => $value) {
            $fieldsForSql[] = "`$field`";
            $param = ':' . $field;
            $paramsForSql[] = $param;
            $placeholdersForQuery[$param] = $value;
        }

        $sql = "INSERT INTO " . static::getTableName() . " (" . implode(', ',$fieldsForSql) . ") VALUES (" .
            implode(', ', $paramsForSql) . ")";

        $db = Db::getInstance();
        $db->query($sql, $placeholdersForQuery);

        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyCamelCaseName = $property->getName();
            $propertyDbName = $this->camelCaseToUnderscore($propertyCamelCaseName);
            $mappedProperties[$propertyDbName] = $this->$propertyCamelCaseName;
        }
        return $mappedProperties;
    }

    private function refresh(): void
    {
        $objFromDb = static::getById($this->id);
        $reflector = new \ReflectionObject($objFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objFromDb);
        }
    }

    private function underscoreToCamelCase(string $origin): string
    {
        return lcfirst(str_replace('_', '',ucwords($origin, '_')));
    }

    private function update(array $mappedProperties): void
    {
        $stringsForSql = [];
        $placeholdersForQuery = [];
        $index = 1;

        foreach ($mappedProperties as $name => $value) {
            $param = ':param' . $index;
            $index++;
            $stringsForSql[] = "`$name`=$param";
            $placeholdersForQuery[$param] = $value;
        }

        $sql = "UPDATE " . static::getTableName() . " SET " . implode(', ', $stringsForSql) .
            " WHERE `id` = " . $this->id;

        $db = Db::getInstance();
        $db->query($sql, $placeholdersForQuery);
    }
}
