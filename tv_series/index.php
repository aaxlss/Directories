<?php
    
    require 'vendor/autoload.php';

    use Model\tvSerie;
    use Model\Connection;
    use Model\TvSerieInterval;

    $connection = new Connection();

    //PDO query getting tv series
    $tvSeries = $connection->getInfo('SELECT  * FROM tv_series tv');
    //PDO query getting tv series intervals
    $tvSeriesIntervals = $connection->getInfo('SELECT  * FROM tv_series tv INNER JOIN tv_series_intervals tsi ON tv.id = tsi.id_tv_series')->fetchAll();

    //PDO query getting tv series by title
    $tvSeriesByTitle = $connection->getInfo('SELECT  * FROM tv_series tv INNER JOIN tv_series_intervals tsi ON tv.id = tsi.id_tv_series WHERE tv.title LIKE \'%3%\'')->fetchAll();

    $nextSerie = '';//this will store the next closest series according to the current time
    foreach($tvSeriesIntervals as $tvSerieInterval){
        //Creating object to get tv series interval
        $tvSerieIntervalObj = new TvSerieInterval($tvSerieInterval->id, $tvSerieInterval->title, $tvSerieInterval->channel, $tvSerieInterval->gender, $tvSerieInterval->week_day, $tvSerieInterval->show_time);
        //if the currect time is less that the time from the tv serie show
        if ( time() < strtotime($tvSerieIntervalObj->getShowTime()) ){
            if($nextSerie === 0) {//if is the firs series to validate will be assigned to to nextSerie available;
                $nextSerie = $tvSerieIntervalObj;
            } else if( strtotime($nextSerie->getShowTime()) >  strtotime($tvSerieIntervalObj->getShowTime())){//if the store serie is greater than the current selected serie, this will get replace by closer one
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