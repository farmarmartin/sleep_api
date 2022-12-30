<?php
include '../functions.php';
// url example: http://localhost/sleep_api/api1/?operation=sleep&param=4,20,6

$url = $_SERVER["REQUEST_URI"];

$operation = filter_input(INPUT_GET, 'operation');
$parameters = explode(",", filter_input(INPUT_GET, 'param'));

if(empty($operation)){
    reply(whenToWakeUp());
}


if($operation == 'wake'){
    reply(whenToWakeUp($parameters[0]));
}


if($operation == 'sleep'){
    reply(whenToSleep($parameters[0], $parameters[1], $parameters[2]));
}

if($operation == 'plannedSleep'){
    reply(whenToWakeUpBasedOnTime($parameters[0], $parameters[1], $parameters[2]));
}