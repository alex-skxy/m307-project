<?php
require 'app/Models/LoanModel.php';

class OverviewController
{
    public function index()
    {
        $result = LoanModel::fetchLoans();

        require 'app/Views/overview.view.php';
    }
}

