<?php
require 'app/Models/Example.php';

class CreateController
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create($_POST);
        } else {
            $exampleModel = new Example();
            $creditpackageData = $exampleModel->getAll("creditpackage");
            require 'app/Views/create.view.php';
        }
    }


    public function create($data)
    {
        $pdo = db();
        $statement = $pdo->prepare("INSERT INTO loan (name, lastname, email, phone_number, installments, fk_creditpackage_id) VALUES (:name, :lastname, :phone_number, :phone_number, :installments, :creditpackage_id);");
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':lastname', $_POST['lastname']);
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':phone_number', $_POST['phone_number']);
        $statement->bindParam(':installments', $_POST['installments']);
        $statement->bindParam(':creditpackage_id', $_POST['creditpackage']);

        $statement->execute();
        $result = $statement->fetchAll();
    }
}

