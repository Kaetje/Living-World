<?php
$key=$_GET["key"];
require "database.php";
require "functions.php";
$character=getcharacter($key);
?>


<h1><?php echo $character["charname"]; ?></h1>
<h2><?php echo $character["playername"]; ?></h2>
<?php echo 'Level '; echo calculateLevel($character["XP"]); ?> <br/>
<?php echo (int)$character["XP"]; echo ' XP' ; ?>


