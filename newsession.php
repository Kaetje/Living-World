<?php
require_once "autoload.php";
$database=new database();
$playerRepository=new PlayerRepository($database);
$playersQuery=$playerRepository->getPlayersQuery();
?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style1.css">
        <title>Initiate New Session</title>
    </head>

    <body>
<?php
require "navbar.php"
?>

<form method="post">
    <?php
    $initiator=new FormSelect('Initiator', 'Initiator', 'Initiator', 'Initiator', $playerRepository);
    $initiator->setQuery($playersQuery);
    echo $initiator->renderItem();
    ?>
    <label for="Initiator">Initiator:</label><br/>
    <select id="Initiator" name="Initiator">
        <option value="1" >Karin</option>
        <option value="2" >Peter</option></select><br/>
    <label for="Date">Date:</label><br/>
    <input id="Date" type="date" name="Date"/><br/>
    <label for="Level_Range">Level Range:</label><br/>
    <select id="Level_Range" name="Level_Range">
        <option value="1" >1-4</option>
        <option value="2" >3-6</option></select><br/>
    <label for="Mission">Mission:</label><br/>
    <input id="Mission" type="text" name="Mission"/><br/>
    <label for="Buddy">Buddy:</label><br/>
    <select id="Buddy" name="Buddy">
        <option value="1" >Karin</option>
        <option value="2" >Peter</option></select><br/>
    <input type="submit" value="Submit"/>
</form>
    </body>
    </html>