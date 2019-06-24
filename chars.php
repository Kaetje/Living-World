<?php
require_once "functions.php";
require_once "database.php";
if(isset($_POST["PlayerName"])){
    addcharacter($_POST["CharacterName"], $_POST["PlayerName"], $_POST["Race"], $_POST["Class"]);
}
$characters=getcharacters();

?>

<a href="export.php">Export table to WikiMedia format.</a><br />
<br />
<table style="width:100%">
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
            <td><a href="charoverview.php?key=<?php echo $character["charid"]; ?>"><?php echo $character["charname"]; ?></a></td>
            <td><?php echo $character["playername"]; ?></td>
            <td><?php echo $character["race"]; ?></td>
            <td><?php echo $character["class"]; ?></td>
            <td><?php echo calculateLevel($character["XP"]);?></td>
            <td><?php echo (int)$character["XP"]; ?></td>
            <td><?php echo $characters['status']; ?></td>

        </tr>
    <?php endforeach; ?>

</table>

<form method="post">
    <label for="CharacterName">Character Name:</label> <input id="CharacterName" type="text" name="CharacterName"/><br/>
    <label for="PlayerName">Player Name:</label> <input id="PlayerName" type="text" name="PlayerName"/><br/>
    <label for="Race">Race:</label> <input id="Race" type="text" name="Race"/><br/>
    <label for="Class">Class:</label> <input id="Class" type="text" name="Class"/><br/>
    <input type="submit" value="Submit"/>
</form>