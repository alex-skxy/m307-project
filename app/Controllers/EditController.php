<?php
require 'app/Models/CreditpackageModel.php';
require 'app/Models/LoanModel.php';

class EditController
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->edit($_POST);
            $rooturl = ROOT_URL;
            header( "Location: $rooturl/list" );
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
        $validation_result = $this->validateData($data);
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
        $statement->bindParam(':id', $data['id']);
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

    public function validateData($data): array
    {
        $errors = [];
        $simpletext_regex = "/^[\p{L} ]+$/";
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $phone_regex = "/^[+0][\d ]+$/";

        if (!(isset($data['name']) && preg_match($simpletext_regex, $data['name']))) {
            $errors[] = "Name can't be empty or contain any numbers or special characters";
        }

        if (!(isset($data['lastname']) && preg_match($simpletext_regex, $data['lastname']))) {
            $errors[] = "Lastname can't be empty or contain any numbers or special characters";
        }
        if (!(isset($data['email']) && preg_match($email_regex, $data['email']))) {
            $errors[] = "Email can't be empty and must contain an @ and a domain name";
        }
        if (!(isset($data['phone_number']) && preg_match($phone_regex, $data['phone_number']))) {
            $errors[] = "Phone number can't be empty and can only contain numbers, whitespace and a +";
        }
        if (!(isset($data['creditpackage']) && is_numeric($data['creditpackage']) && $data['creditpackage'] >= 0 && $data['creditpackage'] < 46)) {
            $errors[] = "No such loan package";
        }

        return $errors;
    }
}

