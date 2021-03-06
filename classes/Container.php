<?php

class Container {
    //properties
    protected $name = "Naam";
    protected $description = "Beschrijving";
    protected $date = 2021-03-17;
    protected $link = 1;
    protected $languageId = 0;

    //methods
    //constructor
    public function __construct($name, $desc, $date, $link, $languageId){
        $this->name = $name;
        $this->description = $desc;
        $this->date = $date;
        $this->link = $link;
        $this->languageId = $languageId;
    }

    //getters & setters
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDesc(){
        return $this->description;
    }

    public function setDesc($desc){
        $this->description = $desc;
    }

    public function getDate(){
        return $this->date;
    }

    public function getLink(){
        return $this->link;
    }

    public function getLangId(){
        return $this->languageId;
    }
}
