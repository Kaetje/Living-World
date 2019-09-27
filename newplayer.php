<?php
require_once "autoload.php";
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
    <label for="Player_Name">Player Name:</label><br/>
    <input id="Player_Name" type="text" name="Player_Name"/><br/><br/>
    <input type="submit" value="Submit"/>
</form>
    </body>
    </html>