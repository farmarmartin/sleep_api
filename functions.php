<?php

function reply($data){
    echo(json_encode($data));
    exit;
}

function minuteFormat($x, $y){
    $min_h = $y - $x;
    $min_m = $min_h * 60;
    return round($min_m);
}

function whenToWakeUp($countOfCyclesWanted = 5){

    $hours = date("H");
    $mins = date("i");

    $cycle = 90 * $countOfCyclesWanted;
    $minsTillSleep = 15;

    $currenTime = $hours * 60 + $mins;

    //wake up time (hours)
    $wakeAt = ($currenTime + $cycle + $minsTillSleep) / 60;

    $extractTime = explode("." ,$wakeAt);

    $hour = $extractTime[0];

    $minutes = $wakeAt - $hour;

    if ($hour > 23){
            $hour = $hour % 24;
    }

    if ($minutes > 59){

        $hour+=1;
        $minutes = $minutes % 60;
     }

    $legitMinutes = round($minutes * 60);
    $result = array("hour" => "$hour", "min" => "$legitMinutes");

   return $result;
}


function whenToSleep($h, $m, $countOfCyclesWanted, $date = null){
    if ($h > 23 || $m > 59){
        echo "wrong format, max is 23 for hours and 59 for minutes. ";
    }else{
        $entire_sleep_time = 1.5 * $countOfCyclesWanted;
        $wakeup_time = $h + $m / 60;
        $gosleep_time = $wakeup_time - $entire_sleep_time;


        $ext = explode(".", $gosleep_time);
        $min = minuteFormat($ext[0], $gosleep_time); 
        $hhour = $ext[0];


        if ($min < 0){
            $hhour -= 1;
            $min = 60 + $min;
        }

        if ($hhour < 0){
            $hhour = 24 + $gosleep_time;
        }


        $hour = floor($hhour);

        if ($date == null){
            $result = ["hour" => "$hour", "min" => "$min"];

        }
        elseif($date != null){
            $result = ["hour" => "$hour", "min" => "$min", "date" => "$date"];
        }
        
        return $result;
    }
}