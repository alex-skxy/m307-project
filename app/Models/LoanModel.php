<?php


class LoanModel
{
    public function load(string $table, int $id)
    {
        $statement = db()->prepare('SELECT * FROM ' . $table . ' WHERE id_loan = :id LIMIT 1');
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }
}