<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <textarea name="input" id="input" cols="50" rows="3" placeholder='example: {"hours":"6","min":"20","cycles":"5"}'></textarea>
        <input type="submit" value="submit">
    </form>

    <?php
        include '../functions.php';

        $url = $_SERVER["REQUEST_URI"];
        $parameters = explode("/", $url);


        $JSONdata = $_POST['input'];
        $data = json_decode($JSONdata, true);
        $operation = $parameters[3];
        $hours = $data["hours"];
        $minutes = $data["min"];
        $cycles = $data["cycles"];
        date_default_timezone_set('Europe/Prague');
        $date = date("Y-M-D h:i:s");
      

        if ($operation == 'wake'){
            reply(whenToWakeUp($cycles));
        }
        if ($operation == 'sleep'){
            reply(whenToSleep($hours, $minutes, $cycles, $date));
        }
        if ($operation == 'plannedSleep'){
            reply(whenToWakeUpBasedOnTime($hours, $minutes, $cycles, $date));
        }


    ?>
</body>
</html>