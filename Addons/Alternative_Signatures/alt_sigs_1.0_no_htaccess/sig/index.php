<?php
$id = htmlspecialchars($_GET['id']);
$template = htmlspecialchars($_GET['template']);
if (!empty($id)) {

// LOAD FILES
require("config.php");
require("../config.php");
require("inc/dbconnect.php");
require("inc/functions.php");
require("inc/lang.php");
require("inc/queries.php");


// SETTING BACKGROUND
if (($template == "") OR (!isset($template))) $template = 1;
$background = "img/bg".$template.".gif";

// CONVERTING HTML2RGB
$text_color_title = html2rgb($text_color_title);
$text_color = html2rgb($text_color);
$weapon_bg = html2rgb($weapon_bg);

if ($sql2['onlinetime'] != 0) {

	// TIME FORMATING
	$seponline = seponline($sql2['onlinetime']);
	$hours = $seponline[0];
	$minutes = $seponline[1];
	$seconds = $seponline[2];

	// COUNT K/D rate
	if ($sql2['deaths'] == 0) $sql2['deaths'] = 1;
	$kdrate = round($sql2['kills'] / $sql2['deaths'], 2);

} else {
	
	// IF NO INFO
	$hours = 0;
	$minutes = 0;
	$seconds = 0;
	$kdrate = 0;
}

// CREATING IMAGE
$expireTime = 1800;

header("Content-type: image/png");
header("Cache-Control: public");
header('Expires: '.gmdate("D, d M Y H:i:s", time() + $expireTime).' GMT');

$img = imagecreatetruecolor($image_width, $image_height);

$bg = imagecreatefromgif($background);
imagecopyresampled($img, $bg, 0, 0, 0, 0, $image_width, $image_height, $image_width, $image_height);

$text_color_title = imagecolorallocate($img, $text_color_title[0], $text_color_title[1], $text_color_title[2]);
$text_color = imagecolorallocate($img, $text_color[0], $text_color[1], $text_color[2]);

$weaponbg = imagecreatetruecolor(79,25);
$color = ImageColorAllocate($weaponbg, $weapon_bg[0], $weapon_bg[1], $weapon_bg[2]);
imagefill($weaponbg, 0, 0, $color);
imagecopyresampled($img, $weaponbg, $image_width - 90, 30, 0, 0, 79, 25, 79, 25);

if (!empty($sql5['uniqueid'])) {

	// ADDING WEAPON IMAGE
	$weapon = imagecreatefromgif("../$images/weapons/halflife/".$sql9['value']."/".$sql5['uniqueid'].".gif");
	imagecopyresampled($img, $weapon, $image_width-90, 30, 0, 0, 79, 25, 79, 25);
} else {

	$sql4['kills'] = 0;
	$sql4['headshotkills'] = 0;
}

// ADDING STATS IN THE IMAGE
if (empty($sql8['cc'])) $sql8['cc'] = "00";
$flag = imagecreatefrompng("../$images/flags/".strtolower($sql8['cc']).".png");
imagecopyresampled($img, $flag, 4, 3, 0, 0, 18, 12, 18, 12);

imagettftext($img, 8, 0, 25, 13, $text_color_title, $font_title, $sql['name']);
imagettftext($img, 8, 0, $image_width - 90, 13, $text_color_title, $font_title, $lang11[$lang].": #".$sql3['rank']);

imagettftext($img, 8, 0, 5, 30+2, $text_color, $font, $lang01[$lang].": ".$sql3['skill']);
imagettftext($img, 8, 0, 5, 45+2, $text_color, $font, $lang02[$lang].": ".$sql2['kills']);
imagettftext($img, 8, 0, 5, 60+2, $text_color, $font, $lang03[$lang].": ".$sql2['deaths']);
imagettftext($img, 8, 0, 5, 75+2, $text_color, $font, $lang04[$lang].": ".$kdrate);
imagettftext($img, 8, 0, 5, 90+2, $text_color, $font, $lang05[$lang].": ".$sql2['accuracy']."%");

imagettftext($img, 8, 0, 125, 30+2, $text_color, $font, $lang06[$lang].": ".$sql2['headshotkillspct']."%");
imagettftext($img, 8, 0, 125, 45+2, $text_color, $font, $lang07[$lang].": ".$sql5['uniqueid']);
imagettftext($img, 8, 0, 125, 60+2, $text_color, $font, $lang08[$lang].": ".$sql7['uniqueid']);
imagettftext($img, 8, 0, 125, 75+2, $text_color, $font, $lang09[$lang].": $hours:$minutes:$seconds");
imagettftext($img, 8, 0, 125, 90+2, $text_color, $font, $lang10[$lang].": ".$sql2['ffkills']);


imagettftext($img, 8, 0, 260, 75+2, $text_color, $font, $lang02[$lang].": ".$sql4['kills']);
imagettftext($img, 8, 0, 260, 90+2, $text_color, $font, $lang06[$lang].": ".$sql4['headshotkills']);

// ENDING
imagepng($img);
imagedestroy($img);
}
?>