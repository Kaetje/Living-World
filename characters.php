<?php

require_once "autoload.php";
$database=new database();
$CharacterRepository=new CharacterRepository($database);
if(isset($_POST["CharacterName"])){
    $CharacterRepository->addcharacter($_POST["CharacterName"], $_POST["PlayerName"], $_POST["Race"], $_POST["Class"]);
}
$charactersQuery=$CharacterRepository->getcharactersQuery();

//the following is to create and fill the formSelectDataPlayer
$playerRepository=new PlayerRepository($database);
$playersQuery=$playerRepository->getPlayersQuery();
$playerObjects=$playerRepository->getPlayersFromQuery($playersQuery);
$formSelectDataPlayer=[];
foreach ($playerObjects as $playerObject)
{
    $formSelectDataPlayer[$playerObject->getId()]=$playerObject->getPlayername();
}

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


<h2>Add a new character:</h2>
<form method="post">
    <label for="CharacterName">Character Name:</label><br/>
    <input id="CharacterName" type="text" name="CharacterName"/><br/>
    <?php
    $initiator=new FormSelect('Player Name', 'PlayerName', 'PlayerName', $formSelectDataPlayer);
    echo $initiator->renderItem();
    ?>
    <label for="Race">Race:</label><br/>
    <input id="Race" type="text" name="Race"/><br/>
    <label for="Class">Class:</label><br/>
    <input id="Class" type="text" name="Class"/><br/>
    <input type="submit" value="Submit"/>
</form>
</body>
</html>