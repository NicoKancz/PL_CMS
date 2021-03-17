<?php


class Article{
    //properties
    protected $name = "Naam";
    protected $description = "Beschrijving";
    protected $image = "./img/image.jpg";
    protected $date = 2021-03-17;

    //methods
    //constructor
    public function __construct($name, $desc, $date, $img){
        $this->name = $name;
        $this->description = $desc;
        $this->date = $date;
        $this->image = $img;
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
        $this->name = $desc;
    }

    public function getDate(){
        return $this->date;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($img){
        $this->image = $img;
    }
}