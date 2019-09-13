<?php
$key=$_GET["key"];
require_once "functions.php";
require_once "classes/database.php";
require_once "classes/Table.php";
require_once "classes/TableColumn.php";
require_once "classes/TableColumnCharName.php";
require_once "classes/CharacterRepository.php";
require_once "classes/EventRepository.php";
$database=new database();
$CharacterRepository=new CharacterRepository($database);
$EventRepository=new EventRepository($database);
$character=$CharacterRepository->getcharacter($key);
$EventsQuery=$EventRepository->getEventsQuery($key);


?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title><?php echo $character->getCharname(); ?></title>
</head>

<body>
<?php
require "navbar.php"
?>

<h1 class="charname"><?php echo $character->getCharname(); ?></h1>
<h2><?php echo 'Level '; echo $character->getLevel(); ?> - <?php echo $character->getXP(); echo ' XP' ; ?></h2>
<p>Eigendom van: <?php echo $character->getPlayerName(); ?></p>


<?php
$table=new Table('charoverview.php?key='.$key, $EventRepository);
$table->addColumn(new TableColumn('Session number', 'getSessionnumber', 'sessionnumber'));
$table->addColumn(new TableColumn('Description', 'getDescription', 'description'));
$table->addColumn(new TableColumn('XP amount', 'getXP', 'XP'));
$table->setQuery($EventsQuery);
echo $table->render();
?>




</body>
</html>