<?php

class Game {
    private $id;
    private $title;
    private $genre;
    private $platform;
    private $release;
    private $rating;
    private $image;

    //set functions
    public function __construct($data) {
        $this->id = $data['id'];          
        $this->title = $data['title'];    
        $this->genre = $data['genre'];    
        $this->platform = $data['platform']; 
        $this->release = $data['release']; 
        $this->rating = $data['rating'];   
        $this->image = $data['imageName'];     
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setgenre($genre) {
        $this->genre = $genre;
    }
    public function setplatform($platform) {
        $this->platform = $platform;
    }

    public function setrelease($release) {
        $this->release = $release;
    }

    public function setrating($rating) {
        $this->rating = $rating;
    }

    public function setimage($image) {
        $this->image = $image;
    }

    //get functions

    public function getid() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getgenre() {
        return $this->genre;
    }

    public function getplatform() {
        return $this->platform;
    }


    public function getrelease() {
        return $this->release;
    }


    public function getrating() {
        return $this->rating;
    }

    public function getimage() {
        return $this->image;
    }

}