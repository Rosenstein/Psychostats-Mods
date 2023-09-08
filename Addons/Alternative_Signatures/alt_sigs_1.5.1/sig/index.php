<?php
error_reporting(E_ALL);
if (!isset($_GET['template']) OR $_GET['template'] == "") $_GET['template'] = 1;
$id = htmlspecialchars($_GET['id']);
$template = htmlspecialchars($_GET['template']);
$miniskin = false;
$space = "0";
$abs_dir = __DIR__ . "/";

if (isset($_GET['mini'])) $miniskin = htmlspecialchars($_GET['mini']);
if (!empty($id)) {

// LOAD FILES
require("config.php");
require("../config.php");
require("inc/dbconnect.php");
require("inc/functions.php");
require("inc/lang.php");
require("inc/queries.php");


// SETTING BACKGROUND
$background = "img/bg".$template.".gif";

// CONVERTING HTML2RGB
$text_color_title = html2rgb($text_color_title);
$text_color = html2rgb($text_color);

if ($plr['onlinetime'] != 0) {

	// TIME FORMATING
	$seponline = seponline($plr['onlinetime']);
	$hours = $seponline[0];
	$minutes = $seponline[1];
	$seconds = $seponline[2];

	// COUNT K/D rate
	if ($plr['deaths'] == 0) $plr['deaths'] = 1;
	if ($plr['shots'] == 0) $plr['shots'] = 1;
	$kdrate = round($plr['kills'] / $plr['deaths'], 2);
	$shrate = round($plr['hits'] / $plr['shots'] * 100);
	if (strlen($shrate) > 3) $shrate = 100;

} else {
	
	// IF NO INFO
	$hours = 0;
	$minutes = 0;
	$seconds = 0;
	$kdrate = 0;
}

// CREATING IMAGE

if (!$debug)
	header("Content-type: image/png");
	header("Cache-Control: public");
	header('Expires: '.gmdate("D, d M Y H:i:s", time() + $expireTime).' GMT');

$img = imagecreatetruecolor($image_width, $image_height);

$bg = imagecreatefromgif($background);
imagecopyresampled($img, $bg, 0, 0, 0, 0, $image_width, $image_height, $image_width, $image_height);

$text_color_title = imagecolorallocate($img, $text_color_title[0], $text_color_title[1], $text_color_title[2]);
$text_color = imagecolorallocate($img, $text_color[0], $text_color[1], $text_color[2]);

if (!empty($wpn['uniqueid'])) {
	
	// ADDING WEAPON IMAGE
	$weaponimgpath = "../$images/weapons/".$gametype['value']."/".$etc['value']."/".$wpn['uniqueid'];
	
	if ($weapon_ext == ".gif") $weapon = imagecreatefromgif($weaponimgpath.$weapon_ext);
	if ($weapon_ext == ".png") $weapon = imagecreatefrompng($weaponimgpath.$weapon_ext);
	if ($weapon_ext == ".webp") $weapon = imagecreatefromwebp($weaponimgpath.$weapon_ext);
	$weaponimgsize = getimagesize($weaponimgpath.$weapon_ext);
	imagecopyresampled($img, $weapon, $image_width-90, 30, 0, 0, 79, 25, $weaponimgsize[0], $weaponimgsize[1]);
} else {
	
	$wpn['kills'] = 0;
	$wpn['headshotkills'] = 0;
}

// ADDING STATS IN THE IMAGE
if ($etc['cc'] == "") $etc['cc'] = "00";
//$flag = imagecreatefrompng("../$images/flags/".strtolower($etc['cc']).".png");
	if ($flag_ext == ".gif") $flag = imagecreatefromgif("../$images/flags/".strtolower($etc['cc']).$flag_ext);
	if ($flag_ext == ".png") $flag = imagecreatefrompng("../$images/flags/".strtolower($etc['cc']).$flag_ext);
	if ($flag_ext == ".webp") $flag = imagecreatefromwebp("../$images/flags/".strtolower($etc['cc']).$flag_ext);
imagecopyresampled($img, $flag, 4, 3, 0, 0, 18, 12, 18, 12);

if ($plr['rank'] > 0 && $plr['rank'] < 4) {
	$cup = imagecreatefrompng("img/".$plr['rank']."pl.png");
	imagecopyresampled($img, $cup, 25, 1, 0, 0, 18, 17, 18, 17);
	$space = 21;
}
imagettftext($img, 8, 0, 25+$space, 13, $text_color_title, $abs_dir.$font_title, $plr['name']);
$box = imagettfbbox(8, 0, $abs_dir.$font_title, $lang11[$lang].": #".$plr['rank']);
imagettftext($img, 8, 0, ceil($image_width - $box[2]) - 18, 13, $text_color_title, $abs_dir.$font_title, $lang11[$lang].": #".$plr['rank']);

if ($plr['rank'] < $plr['prevrank']) $rank = "up";
if ($plr['rank'] > $plr['prevrank']) $rank = "down";
if ($plr['rank'] == $plr['prevrank'] OR $plr['prevrank'] == 0) $rank = "stay";

$rank = imagecreatefromgif("img/rank_".$rank.".gif");
imagecopyresampled($img, $rank, 333, 1, 0, 0, 16, 16, 16, 16);

imagettftext($img, 8, 0, 5, 30+2, $text_color, $abs_dir.$font, $lang01[$lang].": ".$plr['skill']);
imagettftext($img, 8, 0, 5, 45+2, $text_color, $abs_dir.$font, $lang02[$lang].": ".seperate($plr['kills'], 3, ","));
imagettftext($img, 8, 0, 5, 60+2, $text_color, $abs_dir.$font, $lang03[$lang].": ".seperate($plr['deaths'], 3, ","));
imagettftext($img, 8, 0, 5, 75+2, $text_color, $abs_dir.$font, $lang04[$lang].": ".$kdrate);
imagettftext($img, 8, 0, 5, 90+5, $text_color_title, $abs_dir.$font, $lang10[$lang].": ".seperate($plr['shots'], 3, ","));

imagettftext($img, 8, 0, 120, 30+2, $text_color, $abs_dir.$font, $lang06[$lang].": ".$plr[$hskillspct]."%");
imagettftext($img, 8, 0, 120, 45+2, $text_color, $abs_dir.$font, $lang05[$lang].": ".$plr['accuracy']."%");
imagettftext($img, 8, 0, 120, 60+2, $text_color, $abs_dir.$font, $lang08[$lang].": ".$map['uniqueid']);
imagettftext($img, 8, 0, 120, 75+2, $text_color, $abs_dir.$font, $lang09[$lang].": $hours:$minutes:$seconds");

$hits = $lang12[$lang].": ".seperate($plr['hits'], 3, ",")." ($shrate%)";
$box = imagettfbbox(8, 0, $abs_dir.$font, $hits);
imagettftext($img, 8, 0, ceil($image_width - 225), 90+5, $text_color_title, $abs_dir.$font, $hits);

imagettftext($img, 8, 0, 261, 75+1, $text_color, $abs_dir.$font, $lang02[$lang].": ".seperate($wpn['kills'], 3, ","));
imagettftext($img, 8, 0, 261, 90+2, $text_color, $abs_dir.$font, $lang06[$lang].": ".seperate($wpn['headshotkills'], 3, ","));

// SERVER NAME
if ($servername) {
	$img2 = imagecreatetruecolor($image_width, $image_height+15);
	$serverbg = imagecreatefromgif("img/servernamebg.gif");
	
	imagecopyresampled($img2, $img, 0, 0, 0, 0, $image_width, $image_height, $image_width, $image_height);
	imagecopyresampled($img2, $serverbg, 0, $image_height, 0, 0, $image_width, 15, $image_width, 15);
	
	if (strlen($servernametext) > 32) $servernametext = substr($servernametext, 0, 32);
	imagettftext($img2, 7, 0, 5, 111, $text_color, $abs_dir.$font, $lang13[$lang].":");
	$box = imagettfbbox(7, 0, $abs_dir.$font_title, $servernametext);
	imagettftext($img2, 7, 0, ceil($image_width - $box[2]) - 10, 111, $text_color, $abs_dir.$font_title, $servernametext);
	
	$img = $img2;
}

// MINI SIGNATURE
if ($miniskin) {
	$img2 = imagecreatetruecolor($image_width, 19);
	
	imagecopyresampled($img2, $img, 0, 0, 0, 0, $image_width, $image_height, $image_width, $image_height);
	$img = $img2;
}

// ENDING
if (!$debug)
	imagepng($img);
	imagedestroy($img);
}
if ($debug) {
echo "<pre><b>defined_except: 'GLOBALS','_SERVER','_COOKIE','_FILES'</b><br><br>";
print_r (array_diff_key (get_defined_vars(), ['GLOBALS'=>0,'_SERVER'=>0,'_COOKIE'=>0,'_FILES'=>0]));
echo ' '.basename(__FILE__).':'.__LINE__.'</pre>';}
?>