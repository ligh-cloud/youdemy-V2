<?php

require_once 'User.php';

class Student extends User
{
    public function __construct($id = null, $nom = null, $prenom = null, $email = null, $role = 3, $password = null)
    {
        parent::__construct($id, $nom, $prenom, $email, $role, $password);
    }
}
