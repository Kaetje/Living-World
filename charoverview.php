<?php
$key=$_GET["key"];
require_once "functions.php";
require_once "classes/database.php";
$database=new database();
$character=$database->getcharacter($key);
$events=$database->geteventsforcharacter($key);
?>
<header>
    <?php
    require "navbar.php"
    ?>
</header>

<body>
<link rel="stylesheet" type="text/css" href="style1.css">

<h1 class="charname"><?php echo $character->getCharname(); ?></h1>
<h2><?php echo 'Level '; echo $character->getLevel(); ?> - <?php echo $character->getXP(); echo ' XP' ; ?></h2>
<p>Eigendom van: <?php echo $character->getPlayerName(); ?></p>


<table style="width:100%">
    <tr>
        <th>Session number</th>
        <th>Description</th>
        <th>XP amount</th>
    </tr>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?php echo $event["sessionnumber"]; ?></td>
            <td><?php echo $event["description"];?></td>
            <td><?php echo (int)$event["xpamount"]; ?></td>

        </tr>
    <?php endforeach; ?>

</table>
</body>