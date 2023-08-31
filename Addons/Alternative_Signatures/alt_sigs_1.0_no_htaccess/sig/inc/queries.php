<?php
$sql = mysql_query("SELECT name FROM ".$dbtblprefix.$plr_ids." WHERE plrid = '$id' ORDER BY totaluses DESC");
$sql = mysql_fetch_array($sql);

$sql2 = mysql_query("SELECT accuracy, kills, deaths, onlinetime, ffkills, headshotkillspct FROM ".$dbtblprefix."c_plr_data WHERE plrid = '$id'");
$sql2 = mysql_fetch_array($sql2);

$sql3 = mysql_query("SELECT rank, skill, uniqueid FROM ".$dbtblprefix."plr WHERE plrid = '$id'");
$sql3 = mysql_fetch_array($sql3);

$sql4 = mysql_query("SELECT weaponid, kills, headshotkills FROM ".$dbtblprefix."c_plr_weapons WHERE plrid = '$id' ORDER BY kills DESC");
$sql4 = mysql_fetch_array($sql4);

$sql5 = mysql_query("SELECT uniqueid FROM ".$dbtblprefix."weapon WHERE weaponid = '".$sql4['weaponid']."'");
$sql5 = mysql_fetch_array($sql5);

$sql6 = mysql_query("SELECT mapid FROM ".$dbtblprefix."c_plr_maps WHERE plrid = '$id' ORDER BY kills DESC");
$sql6 = mysql_fetch_array($sql6);

$sql7 = mysql_query("SELECT uniqueid FROM ".$dbtblprefix."map WHERE mapid = '".$sql6['mapid']."'");
$sql7 = mysql_fetch_array($sql7);

$sql8 = mysql_query("SELECT cc FROM ".$dbtblprefix."plr_profile WHERE uniqueid = '".$sql3['uniqueid']."'");
$sql8 = mysql_fetch_array($sql8);

$sql9 = mysql_query("SELECT value FROM ".$dbtblprefix."config WHERE var = 'modtype'");
$sql9 = mysql_fetch_array($sql9);
?>