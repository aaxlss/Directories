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