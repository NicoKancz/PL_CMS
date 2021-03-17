<?php


class Role{
    //properties
    protected $name = "Rolnaam";

    //methods
    //constructor
    public function __construct($name){
        $this->name = $name;
    }

    //getters & setters
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }
}