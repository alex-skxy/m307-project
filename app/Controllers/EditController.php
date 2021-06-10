<?php
require 'app/Controllers/ValidationController.php';
require 'app/Models/CreditpackageModel.php';
require 'app/Models/LoanModel.php';

class EditController
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->edit($_POST);
            $rooturl = ROOT_URL;
            header("Location: $rooturl/list");
        } else {
            $creditpackageModel = new CreditpackageModel();
            $loanModel = new LoanModel();
            $creditpackageData = $creditpackageModel->getAll("creditpackage");
            $result = $loanModel->load("loan", $_GET['id']);
            require 'app/Views/edit.view.php';
        }
    }


    public function edit($data)
    {
        $validation_result = ValidationController::validateEdit($data);
        if (count($validation_result) > 0) {
            http_response_code(422);
            echo json_encode($validation_result);
        } else {
            $this->updateLoan($data);
        }
    }

    public function updateLoan($data)
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
        $statement->bindParam(':id', $_GET['id']);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':phone_number', $data['phone_number']);
        $statement->bindParam(':creditpackage_id', $data['creditpackage']);
        $paid_back = isset($data['paid_back']) ? 1 : 0;
        $statement->bindParam(':paid_back', $paid_back);

        $statement->execute();
        $result = $statement->fetchAll();
    }
}

