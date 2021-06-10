<?php


class CreditpackageModel
{
    public function getAll(string $table, string $whereCondition = ''): array
    {
        $db = db();
        $queryString = 'SELECT * FROM '. $table . ' ' . ($whereCondition?('WHERE ' . $whereCondition):'');

        $statement = $db->prepare($queryString);
        $statement->execute();

        return $statement->fetchAll();
    }
}