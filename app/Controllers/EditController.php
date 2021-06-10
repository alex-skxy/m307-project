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
        } else {
            if (isset($_GET['id'])) {
                $creditpackageModel = new CreditpackageModel();
                $loanModel = new LoanModel();
                $creditpackageData = $creditpackageModel->getAll("creditpackage");
                $result = $loanModel->load("loan", $_GET['id']);
                require 'app/Views/edit.view.php';
            } else {
                http_response_code(422);
                echo 'Id parameter is required';
            }
        }
    }


    public function edit($data)
    {
        $validation_result = ValidationController::validateEdit($data);
        if (count($validation_result) > 0) {
            http_response_code(422);
            echo json_encode($validation_result);
        } else {
            $result = LoanModel::updateLoan($_GET['id'], $data);
        }
    }
}

