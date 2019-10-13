<?php
require_once "autoload.php";
$database=new database();

//the following is to create and fill the formSelectDataPlayer
$playerRepository=new PlayerRepository($database);
$playersQuery=$playerRepository->getPlayersQuery();
$playerObjects=$playerRepository->getPlayersFromQuery($playersQuery);
$formSelectDataPlayer=[];
foreach ($playerObjects as $playerObject){
    $formSelectDataPlayer[$playerObject->getId()]=$playerObject->getPlayername();
}

$SessionRepository=new SessionRepository($database);


if(isset($_POST["Date"])){
    //@todo hier dingen inzetten voor submitten van form
    $SessionRepository->addsession($_POST["Initiator"], $_POST["Date"], $_POST["Level_Range"], $_POST["Mission"], $_POST["Buddy"]);
    header('Location: /thanks.php');
    exit;
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
    $initiator=new FormSelect('Initiator', 'Initiator', 'Initiator', $formSelectDataPlayer);
    echo $initiator->renderItem();
    ?>
    <label for="Date">Date:</label><br/>
    <input id="Date" type="date" name="Date"/><br/>
    <label for="Level_Range">Level Range:</label><br/>
    <select id="Level_Range" name="Level_Range">
        <option value="1" >1-4</option>
        <option value="2" >3-6</option>
        <option value="3" >5-8</option>
    </select><br/>
    <label for="Mission">Mission:</label><br/>
    <input id="Mission" type="text" name="Mission"/><br/>
    <?php
    $buddy=new FormSelect('Buddy', 'Buddy', 'Buddy', $formSelectDataPlayer);
    echo $buddy->renderItem();
    ?>
    <input type="submit" value="Submit"/>
</form>
    </body>
    </html>