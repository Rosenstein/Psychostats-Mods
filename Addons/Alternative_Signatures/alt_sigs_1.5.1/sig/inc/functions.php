<?php
// VERSION DIFFRENCES
if ($psycho == "3.1") {
	$images = "img";
	$plr_ids = "plr_ids_name";
} else {
	$images = "images";
	$plr_ids = "plr_ids";
}
if ($difftables) {
	$hskillspct = "headshotpct";
} else {
	$hskillspct = "headshotkillspct";
}


// CONVERTING HEX COLOR TO RGB
function html2rgb($color)
{
    if ($color[0] == '#') {
		$color = substr($color, 1);
	}
    if (strlen($color) == 6) {
		list($r, $g, $b) = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	} else {
		return false;
	}
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
	
    return array($r, $g, $b);
}

// FORMATING ONLINETIME
function seponline($onlinetime)
{
	$minutes = $onlinetime / 60;
	$minutes = floor($minutes);
	
	$hours = $minutes / 60;
	$hours = floor($hours);
	if (strlen($hours) == 1) $hours = "0$hours";
	
	$minutes = $minutes - ($hours * 60);
	if (strlen($minutes) == 1) $minutes = "0$minutes";
	
	$seconds = $onlinetime - ($hours * 60 * 60) - ($minutes * 60);
	if (strlen($seconds) == 1) $seconds = "0$seconds";
	
    return array($hours, $minutes, $seconds);
}

// SEPERATING LONG NUMBERS
function seperate($string, $length, $sep) {

	$strlen = strlen($string);
	if ($strlen > $length) {
		$i = 0;
		$multiplier = $length;
		
		$num = floor($strlen/$length);
		while($i < $num) {
			$string2[] = $sep.substr($string, $strlen - $multiplier, $length);
			$multiplier = $multiplier + $length;
			$i++;
		}
		
		$string2 = array_reverse($string2);
		$result = "";
		$result .= substr($string, 0, $strlen - $num*$length);
		foreach($string2 as $value) {
		    $result .= $value;
		}
		if (substr($result, 0, 1) == $sep)
			$result = substr($result, 1);
	} else {
		$result = $string;
	}
	return $result;
}
?>