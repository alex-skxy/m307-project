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

    public static function fetchLoans(): array
    {
        $pdo = db();
        $statement = $pdo->prepare("SELECT id_loan, l.name, lastname, email, phone_number, installments, c.name as 'credit_package', (DATE_ADD(start_date, INTERVAL (installments*15) DAY)) AS payback_date, (DATEDIFF(NOW(), (DATE_ADD(start_date, INTERVAL (installments*15) DAY)))>0) AS due FROM loan as l
LEFT JOIN creditpackage AS c ON l.fk_creditpackage_id = c.id_creditpackage WHERE paid_back = 0;");
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function updateLoan($id, $data): array
    {
        $pdo = db();
        $statement = $pdo->prepare("UPDATE loan SET
	name = :name,
	lastname = :lastname,
    email = :email,
    phone_number = :phone_number,
    fk_creditpackage_id = :creditpackage_id,
    paid_back = :paid_back
WHERE id_loan = :id;");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':phone_number', $data['phone_number']);
        $statement->bindParam(':creditpackage_id', $data['creditpackage']);
        $paid_back = isset($data['paid_back']) ? 1 : 0;
        $statement->bindParam(':paid_back', $paid_back);

        $statement->execute();
        return $statement->fetchAll();
    }

    public static function createLoan($data): array
    {
        $pdo = db();
        $statement = $pdo->prepare("INSERT INTO loan (name, lastname, email, phone_number, installments, fk_creditpackage_id) VALUES (:name, :lastname, :email, :phone_number, :installments, :creditpackage_id);");
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':phone_number', $data['phone_number']);
        $statement->bindParam(':installments', $data['installments']);
        $statement->bindParam(':creditpackage_id', $data['creditpackage']);

        $statement->execute();
        return $statement->fetchAll();
    }
}
