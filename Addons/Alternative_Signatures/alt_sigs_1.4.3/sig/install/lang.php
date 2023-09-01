<?php
$lang01['en'] = "Installing manual";
$lang01['ru'] = "Инструкция по установке";

$lang02['en'] = "Open/create .htaccess file in your PsychoStats directory ";
$lang02['ru'] = "Откройте/создайте файл .htaccess в папке PsychoStats ";

$lang03['en'] = "Add these lines in .htaccess at the beginning: (on a blank line)";
$lang03['ru'] = "Добавьте эти строки в .htaccess в самом начале: (на чистой строке)";

if (isset($_POST['ver']) == "3.1") {
$lang04['en'] = "Open player_profile.html file in ";
$lang04['ru'] = "Откройте player_profile.html, расположенный в ";
} else {
$lang04['en'] = "Open block_plrsessions.html file in ";
$lang04['ru'] = "Откройте block_plrsessions.html, расположенный в ";
}

$lang05['en'] = "Add these lines at the ending: (on a blank line)";
$lang05['ru'] = "Добавьте эти строки в самом конце: (на чистой строке)";

$lang06['en'] = "Alternative Signatures MOD is installed now!";
$lang06['ru'] = "Alternative Signatures установлен!";

$lang07['en'] = "Your player's pages should now look like this:";
$lang07['ru'] = "Теперь страницы игроков должны выглядеть так:";

$lang08['en'] = "Don't forget to remove install directory!";
$lang08['ru'] = "Не забудьте удалить установочную директорию!";

if (isset($_POST['ver']) == "3.1") {
$lang09['en'] = "Open overall.js file in";
$lang09['ru'] = "Откройте overall.js, расположенный в";
} else {
$lang09['en'] = "Open webcore.js file in";
$lang09['ru'] = "Откройте webcore.js, расположенный в";
}

$lang10['en'] = "steps";
$lang10['ru'] = "шага";
?>