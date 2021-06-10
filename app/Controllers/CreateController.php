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
            $result = LoanModel::createLoan($data);
        }
    }
}

