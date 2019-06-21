<?php
require_once "functions.php";
require_once "database.php";
if(isset($_POST["PlayerName"])){
    addcharacter($_POST["CharacterName"], $_POST["PlayerName"]);
}
$characters=getcharacters();

?>

<table style="width:100%">
    <tr>
        <th>Character name</th>
        <th>Player name</th>
        <th>XP</th>
        <th>Level</th>
    </tr>
    <?php foreach ($characters as $character): ?>
        <tr>
            <td><a href="charoverview.php?key=<?php echo $character["charid"]; ?>"><?php echo $character["charname"]; ?></a></td>
            <td><?php echo $character["playername"]; ?></td>
            <td><?php echo (int)$character["XP"]; ?></td>
            <td><?php echo calculateLevel($character["XP"]);?></td>

        </tr>
    <?php endforeach; ?>

</table>


<form method="post">
    <label for="CharacterName">Character Name:</label> <input id="CharacterName" type="text" name="CharacterName"/><br/>
    <label for="PlayerName">Player Name:</label> <input id="PlayerName" type="text" name="PlayerName"/><br/>
    <input type="submit" value="Submit"/>
</form>