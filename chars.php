<?php

require_once "classes/database.php";
$database=new database();
if(isset($_POST["PlayerName"])){
    $database->addcharacter($_POST["CharacterName"], $_POST["PlayerName"], $_POST["Race"], $_POST["Class"]);
}
$characters=$database->getcharacters();

?>
<header>
    <?php
    require "navbar.php"
    ?>
</header>

<body>
<link rel="stylesheet" type="text/css" href="style1.css">

<a href="export.php">Export table to WikiMedia format.</a><br />
<br />
<table>
    <tr>
        <th>Character name</th>
        <th>Player name</th>
        <th>Race</th>
        <th>Class</th>
        <th>Level</th>
        <th>XP</th>
        <th>Status</th>
    </tr>
    <?php foreach ($characters as $character): ?>
        <tr>
            <td><a href="charoverview.php?key=<?php echo $character->getId(); ?>"><?php echo $character->getCharname(); ?></a></td>
            <td><?php echo $character->getPlayerName(); ?></td>
            <td><?php echo $character->getRace(); ?></td>
            <td><?php echo $character->getClass(); ?></td>
            <td><?php echo $character->getLevel();?></td>
            <td><?php echo $character->getXP(); ?></td>
            <td><?php echo $character->getStatus(); ?></td>

        </tr>
    <?php endforeach; ?>

</table>

<form method="post">
    <label for="CharacterName">Character Name:</label><br/>
    <input id="CharacterName" type="text" name="CharacterName"/><br/>
    <label for="PlayerName">Player Name:</label><br/>
    <input id="PlayerName" type="text" name="PlayerName"/><br/>
    <label for="Race">Race:</label><br/>
    <input id="Race" type="text" name="Race"/><br/>
    <label for="Class">Class:</label><br/>
    <input id="Class" type="text" name="Class"/><br/>
    <input type="submit" value="Submit"/>
</form>
</body>