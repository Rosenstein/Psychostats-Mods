<br><center><span class="title"><?php echo $lang01[$_POST['lang']]; ?></span></center><br><br>

<div class="step">1. <?php echo $lang04[$_POST['lang']]; echo $_POST['address']."themes/default"; ?><br>
<?php echo $lang05[$_POST['lang']]; ?><br><br>

<?php
if ($_POST['ver'] == "3.1") {
// 3.1 VARIANT
?>

<textarea name="code2" rows="18" style="width: 600px;"onClick="javascript:code2.focus(); code2.select();" readonly>
<div class="ps-plr-profile">
	<div class="row">
		<label><#Skin#>:</label>
		<p>
			<select onchange="showopts(this.options[this.selectedIndex].value, {$plr.plrid});">
			<option value="1"><#Grey#>
			<option value="2"><#Black#>
			<option value="3"><#Green#>
			<option value="4"><#Blue#>
			<option value="5"><#Red#>
			<option value="6"><#Orange#>
			<option value="7"><#Purple#>
			<option value="8"><#Turquoise#>
			</select>
		</p>
	</div>
	<div class="row">
		<label><#Signature#>:</label>
		<p><a href="player.php?id={$plr.plrid}"><img name="img" src="sig/index.php?id={$plr.plrid}&template=1"></a>
		</p>
	</div>
	<div class="row">
		<label><#BBCODE#>:</label>

<p><textarea name="clipboard" rows="4" style="width: 350px;" onClick="javascript:clipboard.focus(); clipboard.select();" >
[url=<?php echo $_POST['address']; ?>player.php?id={$plr.plrid}][img]<?php echo $_POST['address']; ?>sig/index.php?id={$plr.plrid}&template=1[/img][/url]
&lt;/textarea&gt;</p>

	</div>
</div></textarea>

<?php
} else {
// OTHER VARIANT
?>

<textarea name="code2" rows="18" style="width: 600px;"onClick="javascript:code2.focus(); code2.select();" readonly>
<div class="frame1">
	<table width="99%" align="center" cellspacing="0" cellpadding="0" border="0">
		<tr valign="middle" onclick="web.toggle_box('plrsignature')">
			<td class="box-hdr"><#Signature#></td>
			<td class="box-hdr" align="right" style="padding-right: 5px">{boximg id='plrsignature'}</td>
		</tr>
	</table>

<div id="box_plrsignature_frame" align="center" {boxframe id='plrsignature'}>
<div class="frame2" style="text-align: left;">
	<a href="player.php?id={$plr.plrid}"><img name="img" src="sig/index.php?id={$plr.plrid}&template=1"></a>
</div>
	<table width="99%" align="center" cellspacing="0" cellpadding="0" border="0">
		<tr valign="middle">
			<td class="box-hdr"><#Skin#></td>
		</tr>
	</table>
<div class="frame2" style="text-align: left;">
			<select onchange="showopts(this.options[this.selectedIndex].value, {$plr.plrid});">
			<option value="1"><#Grey#>
			<option value="2"><#Black#>
			<option value="3"><#Green#>
			<option value="4"><#Blue#>
			<option value="5"><#Red#>
			<option value="6"><#Orange#>
			<option value="7"><#Purple#>
			<option value="8"><#Turquoise#>
			</select>
</div>
	<table width="99%" align="center" cellspacing="0" cellpadding="0" border="0">
		<tr valign="middle">
			<td class="box-hdr"><#BBCODE#></td>
		</tr>
	</table>
<div class="frame2" style="text-align: left;">
<p><textarea name="clipboard" rows="4" style="width: 350px;" onClick="javascript:clipboard.focus(); clipboard.select();" >
[url=<?php echo $_POST['address']; ?>player.php?id={$plr.plrid}][img]<?php echo $_POST['address']; ?>sig/index.php?id={$plr.plrid}&template=1[/img][/url]
&lt;/textarea&gt;</p>
</div>
</div>
</div></textarea>

<?php
}
?>

</div><br><br>

<div class="step">2. <?php echo $lang09[$_POST['lang']]; ?> <?php echo $_POST['address']; ?>themes/default<?php if ($_POST['ver'] == "3.1") echo "/js"; ?><br>
<?php echo $lang05[$_POST['lang']]; ?><br><br>
<textarea name="code3" rows="10" style="width: 600px;"onClick="javascript:code3.focus(); code3.select();" readonly>
function showopts(choice, id) {
	img.src="sig/index.php?id=" + id + "&template=" + choice + "";
	
	element = document.getElementById("clipboard");
	element.focus(); 
	element.select()
	if (document.selection) { 
		SelectedText = element.document.selection.createRange(); 
		SelectedText.text = "[url=<?php echo $_POST['address']; ?>player.php?id=" + id + "][img]<?php echo $_POST['address']; ?>sig/index.php?id=" + id + "&template=" + choice + "[/img][/url]";
	}
}
</textarea>
</div><br><br>

<div class="step"><?php echo $lang06[$_POST['lang']]; ?><br><?php echo $lang07[$_POST['lang']]; ?><br><img src="installed.gif"></div><br><br>

<b><u><?php echo $lang08[$_POST['lang']]; ?></u></b><br>
<br>
<div align=right><i>Author: 3D-GRAF a.k.a F1NAL<br>
E-mail: denkil92@mail.ru<br>
ICQ#: 751306</i></div>

</td></tr></table>