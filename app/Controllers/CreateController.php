<?php
require 'app/Controllers/ValidationController.php';
require 'app/Models/CreditpackageModel.php';
require 'app/Models/LoanModel.php';

class CreateController
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create($_POST);
        } else {
            $CreditpackageModel = new CreditpackageModel();
            $creditpackageData = $CreditpackageModel->getAll("creditpackage");
            require 'app/Views/create.view.php';
        }
    }


    public function create($data)
    {
        $validation_result = ValidationController::validateCreate($data);
        if (count($validation_result) > 0) {
            http_response_code(422);
            echo json_encode($validation_result);
        } else {
            $this->createLoan($data);
        }
    }

    public function createLoan($data)
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
        $result = $statement->fetchAll();
    }
}

