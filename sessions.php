<?php

require_once "autoload.php";
$database = new database();
$sessionRepository = new SessionRepository($database);
$sessionsQuery = $sessionRepository->getSessionsQuery();

if (isset($_POST["SessionDate"])) {
    $sessionRepository->addPlayer($_POST["SessionDate"], $_POST["PlayerName"]);
}

//the following is to create and fill the formSelectDataSession
$sessionObjects = $sessionRepository->getSessionsFromQuery($sessionsQuery);
$formSelectDataSession = [];
foreach ($sessionObjects as $sessionObject) {
    $formSelectDataSession[$sessionObject->getId()] = $sessionObject->getSessiondate();
}

//the following is to create and fill the formSelectDataPlayer
$playerRepository = new PlayerRepository($database);

$playerObjects = $playerRepository->getPlayersFromQuery(new PriorityPlayerQuery($database));
$formSelectDataPlayer = [];
foreach ($playerObjects as $playerObject) {
    $formSelectDataPlayer[$playerObject->getId()] = $playerObject->getPlayername();
}

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Sessions Overview</title>
</head>

<body>
<?php
require "navbar.php"
?>

<h2>Sign up for a session:</h2>
<form method="post">
    <?php
    $session = new FormSelect('Session Date', 'SessionDate', 'SessionDate', $formSelectDataSession);
    echo $session->renderItem();
    ?>
    <?php
    $initiator = new FormSelect('Player Name', 'PlayerName', 'PlayerName', $formSelectDataPlayer);
    echo $initiator->renderItem();
    ?>
    <input type="submit" value="Sign up!"/>
</form>

<?php
$table = new Table('sessions.php', $sessionRepository);
$table->addColumn(new TableColumnSessionDate('Date'));
$table->addColumn(new TableColumn('Level range', 'getLevelrange', 'Level_range'));
$table->addColumn(new TableColumnBoolean('Approved by GM', 'getApproved', 'Approved'));
$table->addColumn(new TableColumn('Mission', 'getMission', 'Mission'));
$table->addColumn(new TableColumn('Initiator', 'getInitiator', 'Initiator'));
$table->addColumn(new TableColumn('Buddy', 'getBuddy', 'Buddy'));
$table->addColumn(new TableColumn('Players', 'getPlayers', 'Players'));
$table->setQuery($sessionsQuery);
echo $table->render();
?>
</body>
</html>