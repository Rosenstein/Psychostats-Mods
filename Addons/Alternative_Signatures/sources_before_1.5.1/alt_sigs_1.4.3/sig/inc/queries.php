<?php
$plr = "SELECT name, accuracy, kills, deaths, hits, onlinetime, ".$hskillspct.", shots, rank, prevrank, skill, uniqueid
		FROM ".$dbtblprefix.$plr_ids." AS pi JOIN ".$dbtblprefix."c_plr_data AS cpd JOIN ".$dbtblprefix."plr AS plr
		WHERE pi.plrid = '$id' and cpd.plrid = '$id' and plr.plrid = '$id'
		ORDER BY pi.totaluses DESC";

$plr = mysql_fetch_array(mysql_query($plr));

$wpn = "SELECT plr_w.weaponid, kills, headshotkills, uniqueid
		FROM ".$dbtblprefix."c_plr_weapons AS plr_w NATURAL JOIN ".$dbtblprefix."weapon
		WHERE plrid = '$id'
		ORDER BY kills DESC
		LIMIT 1";

$wpn = mysql_fetch_array(mysql_query($wpn));

$map = "SELECT cpm.mapid, uniqueid
		FROM ".$dbtblprefix."c_plr_maps AS cpm NATURAL JOIN ".$dbtblprefix."map
		WHERE plrid = '$id'
		ORDER BY kills desc
		LIMIT 1";

$map = mysql_fetch_array(mysql_query($map));

$etc = "SELECT cc, value
		FROM ".$dbtblprefix."plr_profile AS plr_profile JOIN ".$dbtblprefix."config AS config
		WHERE plr_profile.uniqueid = '".$plr['uniqueid']."' and config.var = 'modtype'";

$etc = mysql_fetch_array(mysql_query($etc));
?>