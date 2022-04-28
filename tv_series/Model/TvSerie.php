<?php

namespace Model;

class tvSerie
{

    private $id;
    private $title;
    private $channel;
    private $gender;

    public function __construct($id, $title, $channel, $gender){
        $this->id = $id;
        $this->title = $title;
        $this->channel = $channel;
        $this->gender = $gender;
    }

    public function setId($id){
        $this->id($id);
    }

    public function getId(){
        return $this->id;
    }

    public function setTitle($title){
        $this->title($title);
    }

    public function getTitle(){
        return $this->title;
    }

    public function setChannel($channel){
        $this->channel($channel);
    }

    public function getChannel(){
        return $this->channel;
    }

    public function setGenger($gender){
        $this->gender = $gender;
    }

    public function getGender(){
        return $this->gender;
    }

}
?>