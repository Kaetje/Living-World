<?php
require_once "autoload.php";
$database=new database();
$sessionRepository=new SessionRepository($database);
$sessionsQuery=$sessionRepository->getSessionsQuery();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Approve the sessions!</title>

</head>

<body>
<?php
require "navbar.php";
require "gmbar.php"
?>

<div class="gmpage">
    <?php
    $table=new Table('sessions.php', $sessionRepository);
    $table->addColumn(new TableColumn('Date', 'getSessiondate', 'Date'));
    $table->addColumn(new TableColumn('Level range', 'getLevelrange', 'Level_range'));
    $table->addColumn(new TableColumn('Approved by GM', 'getApproved', 'Approved'));
    $table->addColumn(new TableColumn('Mission', 'getMission', 'Mission'));
    $table->addColumn(new TableColumn('Initiator', 'getInitiator', 'Initiator'));
    $table->addColumn(new TableColumn('Buddy', 'getBuddy', 'Buddy'));
    $table->setQuery($sessionsQuery);
    echo $table->render();
    ?>
</div>

</body>
</html>




