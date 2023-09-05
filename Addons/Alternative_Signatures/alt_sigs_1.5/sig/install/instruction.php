<?php
if (isset($_POST['htaccess']) == "on") {
	$steps = "3";
} else {
	$steps = "2";
}
echo "<br><center><span class=\"title\">".$lang01[$_POST['lang']]." ($steps ".$lang10[$_POST['lang']].")</span></center><br><br>";

// FIRST STEP
if (isset($_POST['htaccess']) == "on") {
	echo "<div class=\"step\">".$lang02[$_POST['lang']]."(".$_POST['address'].")<br>";
	echo $lang03[$_POST['lang']];
	echo "<br><br><textarea name=\"code\" rows=\"8\" style=\"width: 600px;\" onclick=\"this.select();\" readonly>";

// HTACCESS CONTENT
echo "RewriteEngine On
RewriteRule ^sig/sig_([0-9].*)_([0-9].*)_mini.png sig/index.php?id=\$1&template=\$2&mini=true [L,PT]
RewriteRule ^sig/sig_([0-9].*)_mini.png sig/index.php?id=\$1&mini=true [L,PT]

RewriteRule ^sig/sig_([0-9].*)_([0-9].*).png sig/index.php?id=\$1&template=\$2 [L,PT]
RewriteRule ^sig/sig_([0-9].*).png sig/index.php?id=\$1 [L,PT]";
// HTACCESS CONTENT

	echo "</textarea></div><br><br>";
}

// SECOND STEP
echo "<div class=\"step\">".$lang04[$_POST['lang']].$_POST['address']."themes/default<br>";
echo $lang05[$_POST['lang']]."<br><br>";

// 3.1 VARIANT
if ($_POST['ver'] == "3.1") {


// 3.1 HTML CODE
echo "<textarea name=\"code2\" rows=\"18\" style=\"width: 600px;\" onclick=\"this.select();\" readonly>
<!--Alternative Signatures 1.5!-->

<div class=\"ps-plr-profile\">
	<div class=\"row\">
		<label><#Skin#>:</label>
		<table width=\"350\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>
			<select id=\"alt_sig_select\" onchange=\"showopts({\$plr.plrid});\">
			<option value=\"1\"><#Grey#>
			<option value=\"2\"><#Black#>
			<option value=\"3\"><#Green#>
			<option value=\"4\"><#Blue#>
			<option value=\"5\"><#Red#>
			<option value=\"6\"><#Orange#>
			<option value=\"7\"><#Purple#>
			<option value=\"8\"><#Turquoise#>
			</select>
		</td><td align=\"right\">
			<#Mini#> <input id=\"alt_sig_checkbox\" type=\"checkbox\" name=\"size\" onclick=\"showopts({\$plr.plrid});\">
		</td></tr></table>
	</div>
	<div class=\"row\">
		<label><#Signature#>:</label>
		<p><a href=\"player.php?id={\$plr.plrid}\"><img alt=\"\" id=\"signature\" src=\"sig/"; if (isset($_POST['htaccess']) == "on") echo "sig_{\$plr.plrid}_1.png\">"; else echo "index.php?id={\$plr.plrid}&template=1\">";
		echo "</a>
		</p>
	</div>
	<div class=\"row\">
		<label><#BBCODE#>:</label>

<p><textarea name=\"clipboard\" id=\"clipboard\" rows=\"1\" style=\"width: 350px; height: 40px;\" onclick=\"this.select();\" wrap=\"off\" >
[url=".$_POST['address']."player.php?id={\$plr.plrid}][img]".$_POST['address'].""; if (isset($_POST['htaccess']) == "on") echo "sig/sig_{\$plr.plrid}_1.png"; else echo "sig/index.php?id={\$plr.plrid}&template=1";
echo "[/img][/url]
&lt;/textarea&gt;</p>

	</div>
</div>

<!--Alternative Signatures!--></textarea>";
// 3.1 HTML CODE


} else {
// OTHER VARIANT


// OTHER HTML CODE
echo "<textarea name=\"code2\" rows=\"18\" style=\"width: 600px;\" onclick=\"this.select();\" readonly>
<div class=\"frame1\">
	<table width=\"99%\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
		<tr valign=\"middle\" onclick=\"web.toggle_box('plrsignature')\">
			<td class=\"box-hdr\"><#Signature#></td>
			<td class=\"box-hdr\" align=\"right\" style=\"padding-right: 5px\">{boximg id='plrsignature'}</td>
		</tr>
	</table>

<div id=\"box_plrsignature_frame\" align=\"center\" {boxframe id='plrsignature'}>
<div class=\"frame2\" style=\"text-align: left;\">
	<a href=\"player.php?id={\$plr.plrid}\"><img alt=\"\" id=\"signature\" src=\""; if (isset($_POST['htaccess']) == "on") echo "sig/sig_{\$plr.plrid}_1.png"; else echo "sig/index.php?id={\$plr.plrid}&template=1";
	echo "\"></a>
</div>
	<table width=\"99%\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
		<tr valign=\"middle\">
			<td class=\"box-hdr\"><#Skin#></td>
		</tr>
	</table>
<div class=\"frame2\" style=\"text-align: left;\">
		<table width=\"350\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>
			<select id=\"alt_sig_select\" onchange=\"showopts({\$plr.plrid});\">
			<option value=\"1\"><#Grey#>
			<option value=\"2\"><#Black#>
			<option value=\"3\"><#Green#>
			<option value=\"4\"><#Blue#>
			<option value=\"5\"><#Red#>
			<option value=\"6\"><#Orange#>
			<option value=\"7\"><#Purple#>
			<option value=\"8\"><#Turquoise#>
			</select>
		</td><td align=\"right\">
			<#Mini#> <input id=\"alt_sig_checkbox\" type=\"checkbox\" name=\"size\" onclick=\"showopts({\$plr.plrid});\">
		</td></tr></table>
</div>
	<table width=\"99%\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
		<tr valign=\"middle\">
			<td class=\"box-hdr\"><#BBCODE#></td>
		</tr>
	</table>
<div class=\"frame2\" style=\"text-align: left;\">
<p><textarea name=\"clipboard\" id=\"clipboard\" rows=\"1\" style=\"width: 350px; height: 40px;\" onclick=\"this.select();\" wrap=\"off\" >
[url=".$_POST['address']."player.php?id={\$plr.plrid}][img]".$_POST['address']."";if (isset($_POST['htaccess']) == "on") echo "sig/sig_{\$plr.plrid}_1.png"; else echo "sig/index.php?id={\$plr.plrid}&template=1";
echo "[/img][/url]
&lt;/textarea&gt;</p>
</div>
</div>
</div></textarea>";
// OTHER HTML CODE

}


echo "</div><br><br>";

echo "<div class=\"step\">".$lang09[$_POST['lang']]." ".$_POST['address']."themes/default";
if ($_POST['ver'] == "3.1") echo "/js";
echo "<br>";
echo $lang05[$_POST['lang']]."<br><br>";

echo "<textarea name=\"code3\" rows=\"17\" style=\"width: 600px;\" onClick=\"javascript:code3.focus(); code3.select();\" readonly>";

// JS CODE
echo "
function showopts(id) {
	var img = document.getElementById(\"signature\");
	var choice = document.getElementById(\"alt_sig_select\").options[document.getElementById(\"alt_sig_select\").selectedIndex].value;
	var size = document.getElementById(\"alt_sig_checkbox\").checked;
	var element = document.getElementById(\"clipboard\");
	
	if (size == false) size = \"\";
	";
	if (isset($_POST['htaccess']) == "on") {
	echo "if (size == true) size = \"_mini\";"; 
	} else {
	echo "if (size == true) size = \"&mini=true\";";
	}
	echo "
	
	img.src = \"sig/img/loading.gif\";
	img.src = \""; if (isset($_POST['htaccess']) == "on") echo "sig/sig_\" + id + \"_\" + choice + size + \".png\";"; else echo "sig/index.php?id=\" + id + \"&template=\" + choice + size + \"\";";
	
	echo "
	
	element.value = \"[url=".$_POST['address']."player.php?id=\" + id + \"][img]".$_POST['address'].""; if (isset($_POST['htaccess']) == "on") echo "sig/sig_\" + id + \"_\" + choice + size + \".png"; else echo "sig/index.php?id=\" + id + \"&template=\" + choice + size + \"";
	echo "[/img][/url]\";
	element.select();
}";
// JS CODE

echo "</textarea></div><br><br>";

echo "<div class=\"step\">".$lang06[$_POST['lang']]."<br>".$lang07[$_POST['lang']]."<br><img src=\"installed.jpg\"></div><br><br>";
echo "<h2><b><u>".$lang08[$_POST['lang']]."</u></b></h2><br><br>";

echo "<div align=right><i>Author: 3D-GRAF a.k.a F1NAL<br>
E-mail: denkil92@mail.ru<br>
ICQ#: 751306</i><br>
<i>Swedish text: TheAnkA!!</i></div>

</td></tr></table>";
?>