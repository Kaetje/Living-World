<?php
require_once "autoload.php";
$database=new database();
$playerRepository=new PlayerRepository($database);
$playersQuery=$playerRepository->getPlayersQuery();
$playerObjects=$playerRepository->getPlayersFromQuery($playersQuery);
$formSelectData=[];
foreach ($playerObjects as $playerObject){
    $formSelectData[$playerObject->getId()]=$playerObject->getPlayername();
}
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
    $initiator=new FormSelect('Initiator', 'Initiator', 'Initiator', $formSelectData);
    echo $initiator->renderItem();
    ?>
    <label for="Date">Date:</label><br/>
    <input id="Date" type="date" name="Date"/><br/>
    <label for="Level_Range">Level Range:</label><br/>
    <select id="Level_Range" name="Level_Range">
        <option value="1" >1-4</option>
        <option value="2" >3-6</option></select><br/>
    <label for="Mission">Mission:</label><br/>
    <input id="Mission" type="text" name="Mission"/><br/>
    <?php
    $buddy=new FormSelect('Buddy', 'Buddy', 'Buddy', $formSelectData);
    echo $buddy->renderItem();
    ?>
    <input type="submit" value="Submit"/>
</form>
    </body>
    </html>