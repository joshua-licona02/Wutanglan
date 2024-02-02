<?php

date_default_timezone_set('America/New_York'); // Eastern Time

$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];


if($hour < 10){
	$hour = '0'.$hour;
}
if($min < 10){
	$min = '0'.$min;
}
if($sec < 10){
	$sec = '0'.$sec;
}
$current_date = "$year-$month-$date";
$current_date_time = "$date/$month/$year == $hour:$min:$sec";

function getWeekday($date) {
    return date('w', strtotime($date));
}

switch(getWeekday($current_date)){
	case 0: $current_day = "Sunday"; break;
    case 1: $current_day = "M"; break;
    case 2: $current_day = "T"; break;
    case 3: $current_day = "W"; break;
    case 4: $current_day = "R"; break;
    case 5: $current_day = "F"; break;
    case 6: $current_day = "Saturday"; break;
}

echo $current_day;


?>