<?php
include '../functions.php';
// url example: http://localhost/sleep_api/api2/sleep/7/30/5

$url = $_SERVER["REQUEST_URI"];
$parameters = explode("/", $url);

if ($parameters[3] == 'wake'){
    reply(whenToWakeUp($parameters[4]));
}

if ($parameters[3] == 'sleep'){
    reply(whenToSleep($parameters[4], $parameters[5], $parameters[6]));
}