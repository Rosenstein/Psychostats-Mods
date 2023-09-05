<?php
function gdVersion() {
    ob_start();
    phpinfo(8);
    $phpinfo = ob_get_contents();
    ob_end_clean();
    $phpinfo = stristr($phpinfo, "gd version");
    $phpinfo = stristr($phpinfo, "version");

    $end = strpos($phpinfo, "</tr>");
    if($end) {
    	$phpinfo = substr($phpinfo, 0, $end);
    }
    $phpinfo = strip_tags($phpinfo);
	$phpinfo = preg_replace("/[^\.0-9]/", "", $phpinfo);
	
    if (preg_match("@.*([0-9]+)\.([0-9]+)\.([0-9]+).*@", $phpinfo, $r)) {
        $phpinfo=$r[1].".".$r[2].".".$r[3];
    } elseif (preg_match("@.*([0-9]+)\.([0-9]+).*@", $phpinfo, $r)) {
    	$phpinfo=$r[1].".".$r[2].".0";
    } elseif (preg_match("@.*([0-9]+).*@", $phpinfo, $r)) {
    	$phpinfo=$r[1].".0.0";
    } else {
    	$phpinfo=0;
    }

    return($phpinfo);
}
function FreeType() {
    ob_start();
    phpinfo(8);
    $phpinfo = ob_get_contents();
    ob_end_clean();
    $phpinfo = stristr($phpinfo, "FreeType Support");
    $phpinfo = stristr($phpinfo, "Support");

    $end = strpos($phpinfo, "</tr>");
    if($end) {
    	$phpinfo = substr($phpinfo, 0, $end);
    }
    $phpinfo = strip_tags($phpinfo);
	$phpinfo = substr_count($phpinfo, "enabled");

    return($phpinfo);
}
function modrewrite() {
	ob_start();
    phpinfo(8);
    $phpinfo = ob_get_contents();
    ob_end_clean();
    if (substr_count($phpinfo, "Loaded Modules") != 0) {
	    $phpinfo = stristr($phpinfo, "Loaded Modules");
	    $end = strpos($phpinfo, "</tr>");
	    $phpinfo = substr($phpinfo, 0, $end);
	    $phpinfo = substr_count($phpinfo, "mod_rewrite");
	} else {
		$phpinfo = 2;
	}
    
    return($phpinfo);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>INSTALL: Alternative Signature for PsychoStats</title>
<LINK REL="StyleSheet" HREF="install.css" TYPE="text/css">
</head>

<table class="main" cellpadding=15 cellspacing=0><tr><td><img src="logo.gif" width="796" height="151">
</td></tr><tr><td>

<?php
// CURRETLY PATH
$url = $_SERVER['REQUEST_URI'];
$script = strrchr($url, "/");
$script = substr($script, 1, strpos($script, ".php") + 3);
$path = substr($url, 0, strpos($url, $script));

$sig = substr($path, 1, strpos($path, "/install/"));
$ps = substr($path, 1, strpos($path, "/sig/install/"));


// INFORMATION
require("lang.php");
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
		$https = "https://";}
	else {
		$https = "http://";}
$server = $https.$_SERVER['SERVER_NAME']."/";

$gd = gdVersion();
$ft = FreeType();
$mr = modrewrite();


if (substr($gd, 0, 1) == 2) {
	$gds = "true";
} elseif(substr($gd, 0, 1) == 1) {
	$gds = "exclamation";
} else {
	$gds = "false";
}

if ($ft == 1) {
	$ft = "Enabled";
	$fts = "true";
} else {
	$ft = "Disabled";
	$fts = "false";
}

if ($mr == 1) {
	$mrs = "true";
} elseif ($mr == 2) {
	$mrs = "exclamation";
} else {
	$mrs = "false";
}

echo "<center><a href=\"$url\">Reload page</a></center>\r\n";
echo "<table><tr><td></td><td class=\"plugin\">Alternative Signatures for PsychoStats</td>\r\n";
echo "<tr><td></td><td class=\"desc\">Version: 1.5</td></tr>\r\n";

echo "<tr><td><img src=\"$gds.png\"></td><td class=\"plugin\">GD Version: $gd</td></tr>\r\n";
echo "<tr><td></td><td class=\"desc\">GD support is necessary to create signatures.</td></tr>\r\n";

echo "<tr><td><img src=\"$fts.png\"></td><td class=\"plugin\">FreeType Support: $ft</td></tr>\r\n";
echo "<tr><td></td><td class=\"desc\">FreeType Library is necessary to work with fonts.</td></tr>\r\n";

echo "<tr><td><img src=\"$mrs.png\"></td><td class=\"plugin\">mod_rewrite</td></tr>\r\n";
echo "<tr><td></td><td class=\"desc\">mod_rewrite support is necessary to use \"htaccess\" version.</td></tr>\r\n";
echo "<tr><td></td><td class=\"text\">\r\n";

if (empty($_POST['ver'])) {
	echo "<center><table>\r\n";
	echo "<form action=\"install.php\" method=\"POST\">\r\n";
	echo "<tr><td>Your psychostats address:</td><td><input type=\"text\" name=\"address\" style=\"width: 250px;\" autocomplete=\"on\"  value=\"$server$ps\"></td>\r\n";
	echo "</tr>\r\n";
	echo "<tr><td></td><td class=\"site\">Auto-Defined: ".$server.$ps."</td>\r\n";
	echo "</tr>\r\n";
	echo "<tr><td>Language:</td><td><select name=\"lang\" style=\"width: 250px;\"><option value=\"en\">English<option value=\"ru\">Russian<option value=\"sv\">Svenska<option value=\"rs\">Srpski</select></td>\r\n";
	echo "</tr>\r\n";
	echo "<tr><td>Your Psychostats version:</td><td><select name=\"ver\" style=\"width: 250px;\"><option value=\"3.1\">>= 3.1<option value=\"Other\">Other</select></td>\r\n";
	echo "</tr>\r\n";
	echo "<tr><td>\"htaccess\" version:</td><td><input type=checkbox name=\"htaccess\" checked></td>\r\n";
	echo "</tr></table>\r\n";
	echo "<input type=\"submit\" value=\"Next\"></form></table></center>\r\n";
} else {
	$last = substr($_POST['address'], strlen($_POST['address']) - 1, 1);
	if ($last != "/") {
		$_POST['address'] = $_POST['address']."/";
	}
	$domen = substr($_POST['address'], 0, strpos($_POST['address'], "/", 7) + 1);
	$dir = substr($_POST['address'], strpos($_POST['address'], "/", 7) + 1);
	
	require("instruction.php");
}
?>

</td></tr></table>
</html>