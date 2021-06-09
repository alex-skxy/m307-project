<?php

class OverviewController
{
    public function index()
    {
        $hello = 'Overview';

        require 'app/Views/overview.view.php';
    }
}

