<?php
    
    class Connection {

        private $host;
        private $dbname;
        private $user;
        private $password;
        private $dns;
    
    
        public function __construct(){
            $this->db_connection();
        }
    
        private function db_connection(){
            $this->host = 'localhost';
            $this->dbname = 'innodb';
            $this->user = 'root';
            $this->password = '12345';
    
            $this->dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
    
            return $this->dns;
        }
    
    
        public function getInfo($sql){
            $pdo = new PDO($this->dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
            return $pdo->query($sql);
        }
    }

    class tvSerie{

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
            $day;
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

    $connection = new Connection();

    //PDO query getting tv series
    $tvSeries = $connection->getInfo('SELECT  * FROM tv_series tv');
    //PDO query getting tv series intervals
    $tvSeriesIntervals = $connection->getInfo('SELECT  * FROM tv_series tv INNER JOIN tv_series_intervals tsi ON tv.id = tsi.id_tv_series')->fetchAll();

    //PDO query getting tv series by title
    $tvSeriesByTitle = $connection->getInfo('SELECT  * FROM tv_series tv INNER JOIN tv_series_intervals tsi ON tv.id = tsi.id_tv_series WHERE tv.title LIKE \'%3%\'')->fetchAll();

    $nextSerie = 0;
    foreach($tvSeriesIntervals as $tvSerieInterval){
        $tvSerieIntervalObj = new TvSerieInterval($tvSerieInterval->id, $tvSerieInterval->title, $tvSerieInterval->channel, $tvSerieInterval->gender, $tvSerieInterval->week_day, $tvSerieInterval->show_time);
        
        if ( time() < strtotime($tvSerieIntervalObj->getShowTime()) ){
            if($nextSerie === 0) {
                $nextSerie = $tvSerieIntervalObj;
            } else if( strtotime($nextSerie->getShowTime()) >  strtotime($tvSerieIntervalObj->getShowTime())){
                $nextSerie = $tvSerieIntervalObj;
            }
        }
    }

 ?>

<!DOCTYPE html>
<html>
<head>
<title>TV Series</title>
</head>
<body>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Channel</th>
        <th>Gender</th>
    </tr>

    <?php
    foreach($tvSeries as $tvSerie){
        $tvSerieObj = new tvSerie($tvSerie->id, $tvSerie->title, $tvSerie->channel, $tvSerie->gender);
        echo '<tr>
                <td>'
                    .$tvSerieObj->getId().
                '</td>
                <td>'
                    .$tvSerieObj->getTitle().
                '</td>
                <td>'
                    .$tvSerieObj->getChannel().
                '</td>
                <td>'
                    .$tvSerieObj->getGender().
                '</td>
            </tr>';
    }
    ?>
</table>

<div>
    <h2>Next Serie</h2>
    <?php
        echo '<h3>'.$nextSerie->getTitle().'-----'.$nextSerie->convertWeekDay().'-----'.$nextSerie->getShowTime().'</h3>';
    ?>
    <h2>Searching by Title</h2>
    <?php
        foreach($tvSeriesByTitle as $tvSerieByTitle){
            $tvSerieObj = new TvSerieInterval($tvSerieByTitle->id, $tvSerieByTitle->title, $tvSerieByTitle->channel, $tvSerieByTitle->gender, $tvSerieByTitle->week_day, $tvSerieByTitle->show_time);
            echo '<h3>'.$tvSerieObj->getTitle().'-----'.$tvSerieObj->convertWeekDay().'-----'.$tvSerieObj->getShowTime().'</h3>';
        }
       
    ?>
    
</div>
</body>
</html>