<?php

class OverviewController
{
    public function index()
    {
        $pdo = db();
        $statement = $pdo->prepare("SELECT l.name as 'firstname', lastname, email, installments, c.name as 'credit_package', paid_back, (DATE_ADD(start_date, INTERVAL (installments*15) DAY)) AS payback_date FROM loan as l
LEFT JOIN creditpackage AS c ON l.fk_creditpackage_id = c.id_creditpackage;");
        $statement->execute();
        $result = $statement->fetchAll();

        require 'app/Views/overview.view.php';
    }
}

