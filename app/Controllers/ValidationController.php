<?php

class ValidationController
{
    public function index()
    {
        $result = [];
        if ($_GET['q'] === 'edit') {
            $result = $this->validateEdit($_POST);
        } elseif ($_GET['q'] === 'create') {
            $result = $this->validateCreate($_POST);
        }

        if (count($result) > 0) {
            http_response_code(422);
            echo json_encode($result);
        } else {
            echo json_encode('ok');
        }
    }


    public static function validateEdit(array $data): array
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
            $errors['phone_number'] = "Phone number can't be empty and can only contain numbers, whitespace and a +";
        }
        if (!(isset($data['creditpackage']) && is_numeric($data['creditpackage']) && $data['creditpackage'] >= 0 && $data['creditpackage'] < 46)) {
            $errors[] = "No such loan package";
        }

        return $errors;
    }

    public static function validateCreate(array $data): array
    {
        $errors = [];
        $simpletext_regex = "/^[\p{L} ]+$/";
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $phone_regex = "/^[+0][\d ]+$/";

        if (!(isset($data['name']) && preg_match($simpletext_regex, $data['name']))) {
            $errors['name'] = "Name can't be empty or contain any numbers or special characters";
        }
        if (!(isset($data['lastname']) && preg_match($simpletext_regex, $data['lastname']))) {
            $errors['lastname'] = "Lastname can't be empty or contain any numbers or special characters";
        }
        if (!(isset($data['email']) && preg_match($email_regex, $data['email']))) {
            $errors['email'] = "Email can't be empty and must contain an @ and a domain name";
        }
        if (isset($data['phone_number']) && !($data['phone_number'] === '') && !(preg_match($phone_regex, $data['phone_number']))) {
            $errors['phone_number'] = "Phone number can't be empty and can only contain numbers, whitespace and a +";
        }
        if (!(isset($data['installments']) && is_numeric($data['installments']) && $data['installments'] > 0 && $data['installments'] < 11)) {
            $errors['installments'] = "Minimum number of installments is 1, maximum is 10";
        }
        if (!(isset($data['creditpackage']) && is_numeric($data['creditpackage']) && $data['creditpackage'] >= 0 && $data['creditpackage'] < 46)) {
            $errors['creditpackage'] = "No such loan package";
        }

        return $errors;
    }
}
