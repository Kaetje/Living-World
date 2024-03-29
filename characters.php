<?php

require_once "autoload.php";
$database=new database();
$CharacterRepository=new CharacterRepository($database);
if(isset($_POST["PlayerName"])){
    $CharacterRepository->addcharacter($_POST["CharacterName"], $_POST["PlayerName"], $_POST["Race"], $_POST["Class"]);
}

$charactersQuery=$CharacterRepository->getcharactersQuery();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Characters Overview</title>
</head>

<body>
<?php
require "navbar.php"
?>


<a href="export.php">Export table to WikiMedia format.</a><br />
<br />

<?php
$table=new Table('characters.php', $CharacterRepository);
$table->addColumn(new TableColumnCharName('Character name'));
$table->addColumn(new TableColumn('Player name', 'getPlayerName', 'PlayerName'));
$table->addColumn(new TableColumn('Race', 'getRace', 'Race'));
$table->addColumn(new TableColumn('Class', 'getClass', 'Class'));
$table->addColumn(new TableColumn('Level', 'getLevel', 'XP'));
$table->addColumn(new TableColumn('XP', 'getXP', 'XP'));
$table->addColumn(new TableColumn('Status', 'getStatus', 'Status'));
$table->setQuery($charactersQuery);
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