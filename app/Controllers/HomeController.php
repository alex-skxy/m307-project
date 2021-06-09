<?php

class HomeController
{
    public function index()
    {
        $hello = 'Home';

        require 'app/Views/home.view.php';
    }
}

