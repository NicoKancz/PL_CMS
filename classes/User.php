<?php


class User{
    //properties
    protected $name = "Gebruikersnaam";
    protected $email = "Beschrijving";
    protected $password = "Wachtwoord";
    protected $role = "Gebruiker";
    protected $regDate = 2021-03-17;

    //methods
    //constructor
    public function __construct($name, $email, $pw, $role, $regDate){
        $this->name = $name;
        $this->email = $email;
        $this->password = $pw;
        $this->role = $role;
        $this->regDate = $regDate;
    }

    //getters & setters
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setDesc($email){
        $this->email = $email;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getRegDate(){
        return $this->regDate;
    }
}