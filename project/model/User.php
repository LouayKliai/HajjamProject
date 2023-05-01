<?php
class User
{
    private ?int $idUser = null;
    private ?string $lastName = null;
    private ?string $firstName = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?DateTime $dob = null;

    function __construct($idUser = null, $lastName, $firstName, $email,$password, $dob)
    {
        $this->idUser = $idUser;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password= $password;
        $this->dob = $dob;
    }
    function getIdUser()
    {
        return $this->idUser;
    }
    function getLastName(){
        return $this->lastName;
    }
    function getFirstName(){
        return $this->firstName;
    }
    function getEmail(){
        return $this->email;
    }
    function getDob(){
        return $this->dob;
    }
    function getPassword(){
        return $this->password;
    }
}
