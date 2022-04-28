<?php

namespace Model;

class TvSerieInterval extends tvSerie {

    private $week_day;
    private $show_time;

    function __construct($id, $title, $channel, $gender, $week_day, $show_time){
        parent::__construct($id, $title, $channel, $gender);
        $this->week_day = $week_day;
        $this->show_time = $show_time;
    }

    public function setWeekDay($week_day){
        $this->week_day = $week_day;
    }

    public function getWeekDay(){
        return $this->week_day;
    }

    public function setShowTime($show_time){
        $this->show_time = $show_time;
    }

    public function getShowTime(){
        return $this->show_time;
    }

    public function convertWeekDay(){
        $day = '';
        switch($this->week_day){
            case 1: 
                $day = 'Monday';
                break;
            case 2:
                $day = 'Tuesday';
                break;
            case 3:
                $day = 'Wednesday';
                break;
            case 4:
                $day = 'Thursday';
                break;
            case 5:
                $day = 'Friday';
                break;
            case 6:
                $day = 'Saturday';
                break;
            case 7:
                $day = 'Sunday';
                break;
        }
        return $day;
    }
}
?>