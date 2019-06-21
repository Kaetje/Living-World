<?php
require "functions.php";
require "database.php";
if(isset($_POST["xpamount"])){
    addevent($_POST["sessionnumber"], $_POST["description"], $_POST["xpamount"], $_POST["characters"]);
}
$characters=getcharacters();

?>

<form method="post">
    <label for="sessionnumber">Session Number:</label> <input id="sessionnumber" type="text" name="sessionnumber"/><br/>
    <label for="description">Description:</label> <input id="description" type="text" name="description"/><br/>
    <label for="xpamount">XP amount:</label> <input id="xpamount" type="text" name="xpamount"/><br/>

    <?php foreach ($characters as $character): ?>
        <input id="<?php echo $character["charid"]; ?>" type="checkbox" name="characters[]" value="<?php echo $character["charid"]; ?>"/>
        <label for="<?php echo $character["charid"]; ?>"><?php echo $character["charname"]; ?></label> <br/>

    <?php endforeach; ?>

    <input type="submit" value="Submit"/>
</form>
