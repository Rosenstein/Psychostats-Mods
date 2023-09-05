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
?>

<html>
<head>
<title>INSTALL: Alternative Signature for PsychoStats</title>
<LINK REL="StyleSheet" HREF="install.css" TYPE="text/css">
</head>
<html>

<table class="main" cellpadding=15 cellspacing=0><tr><td background="logo.gif" height=151>
</td></tr></tr><td>

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
$server = "http://".$_SERVER['SERVER_NAME']."/";

$gd = gdVersion();


if (substr($gd, 0, 1) == 2) {
	$gds = "true";
} elseif(substr($gd, 0, 1) == 1) {
	$gds = "exclamation";
} else {
	$gds = "false";
}

echo "<table><tr><td></td><td class=\"plugin\">Alternative Signatures for PsychoStats</td>";
echo "<tr><td></td><td class=\"desc\">Version: 1.0 (WITHOUT HTACCESS)</td></tr>";

echo "<tr><td><img src=\"$gds.png\"></td><td class=\"plugin\">GD Version: $gd</td></tr>";
echo "<tr><td></td><td class=\"desc\">GD support is necessary to create signatures.</td></tr>";
echo "<tr><td></td><td class=\"text\">";

if (empty($_POST['ver'])) {
	echo "<center><table>";
	echo "<form action=\"install.php\" method=\"POST\">";
	echo "<tr><td>Your psychostats address:</td><td><input type=\"text\" name=\"address\" style=\"width: 250px;\" value=\"http://yoursite.com/stats/\"></td>";
	echo "</tr>";
	echo "<tr><td></td><td class=\"site\">Auto-Defined: ".$server.$ps."</td>";
	echo "</tr>";
	echo "<tr><td>Language:</td><td><select name=\"lang\" style=\"width: 250px;\"><option value=\"en\">English<option value=\"ru\">Russian</select></td>";
	echo "</tr>";
	echo "<tr><td>Your Psychostats version:</td><td><select name=\"ver\" style=\"width: 250px;\"><option value=\"3.1\">3.1<option value=\"Other\">Other</select></td>";
	echo "</tr></table>";
	echo "<input type=\"submit\" value=\"Next\"></form></center>";
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