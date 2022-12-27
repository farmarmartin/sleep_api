<?php

function reply($data){
    echo(json_encode($data));

    exit;


}

function minuteFormat($number){
    return ($number / 10 * 60);
}

function whenToWakeUp($countOfCyclesWanted = 5){

    $hours = date("H");
    $mins = date("i");

    $cycle = 90 * $countOfCyclesWanted;
    $minsTillSleep = 15;

    $currenTime = $hours * 60 + $mins;

    //wake up time (hours)
    $wakeAt = ($currenTime + $cycle + $minsTillSleep) / 60;

        //hours

    $extractTime = explode("." ,$wakeAt);

    $hour = $extractTime[0];

    $minutes = $wakeAt - $hour;


       

        //formating time

    if ($hour > 23){

            $hour = $hour % 24;

    }


    if ($minutes > 59){

        $hour+=1;

        $minutes = $minutes % 60;
     }

    $legitMinutes = floor($minutes * 60);
    $result = array("$hour" => "$legitMinutes");

   return $result;
}

function whenToSleep($h, $m, $countOfCyclesWanted){

    $entire_sleep_time = 1.5 * $countOfCyclesWanted;
    $wakeup_time = $h + ($m / 60);
    $gosleep_time = $wakeup_time - $entire_sleep_time;

    $ext = explode(".", $gosleep_time);
    $min = minuteFormat($ext[1]);

    if ($ext[0] < 0 && $ext[1] > 0){
        $ext[1]*=-1; //potencional fuckup
    }

    if ($ext[0] < 0){
        $ext[0] = 24 + $gosleep_time;
    }

    if ($min < 0){
        $ext[0] -= 1;
    }
    $hour = floor($ext[0]);

    $result = ["$hour" => "$min"];
    return $result;
    
}
