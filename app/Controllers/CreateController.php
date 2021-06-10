<?php
require 'app/Models/CreditpackageModel.php';
require 'app/Models/LoanModel.php';

class CreateController
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create($_POST);
            $rooturl = ROOT_URL;
            header( "Location: $rooturl/create" );
        } else {
            $CreditpackageModel = new CreditpackageModel();
            $creditpackageData = $CreditpackageModel->getAll("creditpackage");
            require 'app/Views/create.view.php';
        }
    }


    public function create($data)
    {
        $validation_result = $this->validateData($data);
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
        $statement = $pdo->prepare("INSERT INTO loan (name, lastname, email, phone_number, installments, fk_creditpackage_id) VALUES (:name, :lastname, :phone_number, :phone_number, :installments, :creditpackage_id);");
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':phone_number', $data['phone_number']);
        $statement->bindParam(':installments', $data['installments']);
        $statement->bindParam(':creditpackage_id', $data['creditpackage']);

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
        if (isset($data['phone_number']) && !($data['phone_number'] === '') && !(preg_match($phone_regex, $data['phone_number']))) {
            $errors[] = "Phone number can't be empty and can only contain numbers, whitespace and a +";
        }
        if (!(isset($data['installments']) && is_numeric($data['installments']) && $data['installments'] > 0 && $data['installments'] < 11)) {
            $errors[] = "Minimum number of installments is 1, maximum is 10";
        }
        if (!(isset($data['creditpackage']) && is_numeric($data['creditpackage']) && $data['creditpackage'] >= 0 && $data['creditpackage'] < 46)) {
            $errors[] = "No such loan package";
        }

        return $errors;
    }
}

