<?php

require_once "classes/database.php";
require_once "classes/Table.php";
require_once "classes/TableColumn.php";
require_once "classes/TableColumnCharName.php";
$database=new database();
if(isset($_POST["PlayerName"])){
    $database->addcharacter($_POST["CharacterName"], $_POST["PlayerName"], $_POST["Race"], $_POST["Class"]);
}
$characters=$database->getcharacters();

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Character Overview</title>
</head>

<body>
<?php
require "navbar.php"
?>


<a href="export.php">Export table to WikiMedia format.</a><br />
<br />

<?php
$table=new Table('chars.php');
$table->addColumn(new TableColumnCharName('Character name'));
$table->addColumn(new TableColumn('Player name', 'getPlayerName'));
$table->addColumn(new TableColumn('Race', 'getRace'));
$table->addColumn(new TableColumn('Class', 'getClass'));
$table->addColumn(new TableColumn('Level', 'getLevel'));
$table->addColumn(new TableColumn('XP', 'getXP'));
$table->addColumn(new TableColumn('Status', 'getStatus'));
$table->setQuery($characters);
echo $table->render();
?>



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
</html>