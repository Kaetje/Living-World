<?php
require_once "autoload.php";
$database = new database();
$PlayerRepository = new PlayerRepository($database);
if (isset($_POST["PlayerName"])) {
    $PlayerRepository->addplayer($_POST["PlayerName"]);
}
$playersQuery = $PlayerRepository->getPlayersQuery();
?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style1.css">
        <title>Add New Player</title>
    </head>

    <body>
    <?php
    require "navbar.php"
    ?>

    <form method="post">
        <label for="PlayerName">Player Name:</label><br/>
        <input id="PlayerName" type="text" name="PlayerName"/><br/>
        <input type="submit" value="Submit"/>
    </form>
    </body>
    </html>


<?php
$table = new Table('newplayer.php', $PlayerRepository);
$table->addColumn(new TableColumn('Current Players:', 'getPlayerName', 'PlayerName'));
$table->setQuery($playersQuery);
echo $table->render();
?>