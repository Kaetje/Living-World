<?php
require "functions.php";
require_once "classes/database.php";
$database=new database();


if(isset($_POST["xpamount"])){
    $database->addevent($_POST["sessionnumber"], $_POST["description"], $_POST["xpamount"], $_POST["characters"]);
}
$characters=$database->getcharacters();

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Add Event</title>
</head>

<body>
<?php
require "navbar.php"
?>

<form method="post">
    <label for="sessionnumber">Session Number:</label> <input id="sessionnumber" type="text" name="sessionnumber"/><br/>
    <label for="description">Description:</label> <input id="description" type="text" name="description"/><br/>
    <label for="xpamount">XP amount:</label> <input id="xpamount" type="text" name="xpamount"/><br/>

    <?php foreach ($characters as $character): ?>
        <input id="<?php echo $character->getId(); ?>" type="checkbox" name="characters[]" value="<?php echo $character->getId(); ?>"/>
        <label for="<?php echo $character->getId(); ?>"><?php echo $character->getCharname(); ?></label> <br/>

    <?php endforeach; ?>

    <input type="submit" value="Submit"/>
</form>
</body>