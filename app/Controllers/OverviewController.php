<?php

class OverviewController
{
    public function index()
    {
        $pdo = db();
        $statement = $pdo->prepare("SELECT id_loan, l.name, lastname, email, phone_number, installments, c.name as 'credit_package', (DATE_ADD(start_date, INTERVAL (installments*15) DAY)) AS payback_date, (DATEDIFF(NOW(), (DATE_ADD(start_date, INTERVAL (installments*15) DAY)))>0) AS due FROM loan as l
LEFT JOIN creditpackage AS c ON l.fk_creditpackage_id = c.id_creditpackage WHERE paid_back = 0;");
        $statement->execute();
        $result = $statement->fetchAll();


        require 'app/Views/overview.view.php';
    }
}

