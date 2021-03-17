<?php


class Language{
    //properties
    protected $name = "Naam";
    protected $appearance = 2021;

    //methods
    //constructor
    public function __construct($name, $year){
        $this->name = $name;
        $this->appearance = $year;
    }

    //getters & setters
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getAppearance(){
        return $this->appearance;
    }
}