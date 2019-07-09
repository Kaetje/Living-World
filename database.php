<?php

require 'conf.php';

function getcharacters(){
    $db=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query=mysqli_query($db,
        "SELECT PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID 
                GROUP BY charid");
    $characters=mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $characters;
}

function addcharacter($charname, $playername, $race, $class){
    $db=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    mysqli_query($db, "INSERT INTO `characters` (`ID`, `CharacterName`, `PlayerName`, `Race`, `Class`, `Status`) VALUES (NULL, '$charname', '$playername', '$race', '$class', 'Ready')");
}

function getcharacter($charid){
    $db=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query=mysqli_query($db, "SELECT PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status 
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID 
                WHERE characters.ID='$charid'
                GROUP BY charid ");
    $character=mysqli_fetch_array($query, MYSQLI_ASSOC);
    return $character;
}

function addevent($sessionnumber, $description, $xpamount, $characters)
{
    $db=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    mysqli_query($db, "INSERT INTO `xpevents` (`ID`, `sessionnumber`, `description`, `xpamount`) VALUES (NULL, '$sessionnumber', '$description', '$xpamount')");
    $xpevent_id=mysqli_insert_id($db);
    foreach ($characters as $character){
        mysqli_query($db, "INSERT INTO `characters_xpevents` (`character_id`, `xpevent_id`) VALUES ('$character', '$xpevent_id')");
    }
}

function geteventsforcharacter($charid){
    $db=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query=mysqli_query($db,
        "SELECT xpevents.sessionnumber as sessionnumber, xpevents.description as description, xpevents.xpamount as xpamount
                FROM xpevents 
                JOIN characters_xpevents ON xpevents.ID = characters_xpevents.xpevent_id 
                WHERE characters_xpevents.character_id = $charid");
    $events=mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $events;
}