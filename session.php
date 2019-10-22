<?php
$key = $_GET["key"];
require_once "autoload.php";
$database = new database();
$sessionRepository = new SessionRepository($database);

$query = $sessionRepository->getSessionsQuery();
$query->addWhere('ID = ' . (int)$key);

$sessions = $sessionRepository->getSessionsFromQuery($query);
if (!count($sessions)) {
    echo 'No session found.';
    exit;
}
/** @var Session $session */
$session = $sessions[0];

if (isset($_POST["PlayerName"])) {
    $sessionRepository->addPlayer($session->getSessiondate(), $_POST["PlayerName"]);
    $sessions = $sessionRepository->getSessionsFromQuery($query);
    /** @var Session $session */
    $session = $sessions[0];
}

//the following is to create and fill the formSelectDataPlayer
$playerRepository = new PlayerRepository($database);

if ($session->hasPriority()) {
    $query = new PriorityPlayerQuery($database);
} else {
    $query = $playerRepository->getPlayersQuery();
}
$playerObjects = $playerRepository->getPlayersFromQuery($query);
$formSelectDataPlayer = [];
foreach ($playerObjects as $playerObject) {
    $formSelectDataPlayer[$playerObject->getId()] = $playerObject->getPlayername();
}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title><?php echo $session->getId() . ' ' . $session->getMission(); ?></title>
</head>

<body>
<?php
require "navbar.php"
?>

<h1><?php echo $session->getMission() ?></h1>
<h2>Planned for: <?php echo $session->getCreationdatetime(); ?></h2>
<h2>Initiated by: <?php echo $session->getInitiator() ?></h2>

<h2>Level range: <?php echo $session->getLevelrange(); ?></h2>

<div>
    <?php if ($session->getApproved()): ?>
        This session has been approved.
    <?php else: ?>
        This session has not been approved.
    <?php endif ?>
</div>

<div>
    <h2>Sign up!</h2>
    <form method="post">
    <?php if ($session->hasPriority()): ?>
        This session currently has priority sign-up for less active players. If your name is not in the list, be patient. Priority sign-up fades 3 days after the session was planned.
    <?php endif; ?>
    <?php
        $initiator = new FormSelect('Player Name', 'PlayerName', 'PlayerName', $formSelectDataPlayer);
        echo $initiator->renderItem();
    ?>
        <input type="submit" value="Sign up!"/>
    </form>

</div>

</body>
</html>