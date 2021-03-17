<?php


class Comment{
    //properties
    protected $text = "Beschrijving";
    protected $user = "Gebruiker X";
    protected $date = 2021-03-17;
    protected $update = null;

    //methods
    //constructor
    public function __construct($text, $user, $date){
        $this->text = $text;
        $this->user = $user;
        $this->date = $date;
    }

    public function update($date){

    }

    //getters & setters
    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getUser(){
        return $this->user;
    }

    public function getDate(){
        return $this->date;
    }

    public function getUpdate(){
        return $this->update;
    }

    public function setUpdate($date){
        $this->update = $date;
    }
}