<?php
$key=$_GET["key"];
require_once "database.php";
require_once "functions.php";
$character=getcharacter($key);
$events=geteventsforcharacter($key);
?>


<h1><?php echo $character["charname"]; ?></h1>
<h2><?php echo $character["playername"]; ?></h2>
<?php echo 'Level '; echo calculateLevel($character["XP"]); ?> <br/>
<?php echo (int)$character["XP"]; echo ' XP' ; ?>


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