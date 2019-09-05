<?php

require 'conf.php';
require 'classes/Character.php';
require 'classes/Event.php';
class database
{
    private $connection;
    public function __construct()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    private function query($sql)
    {
        $query = mysqli_query($this->connection, $sql);
        if ($query == false){
            echo mysqli_error($this->connection);
            echo $sql;
            exit;
        }
        return $query;
    }

    /**
     * @return Character[]
     */
    function getcharacters(): array
    {
        $query = $this->query(
            "SELECT PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID 
                GROUP BY charid
                ORDER BY charname");
        $characters = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects=[];
        foreach ($characters as $character) {
            $objects[] = new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
        }
        return $objects;
    }

    function addcharacter($charname, $playername, $race, $class)
    {
        $this->query( "INSERT INTO `characters` (`ID`, `CharacterName`, `PlayerName`, `Race`, `Class`, `Status`) VALUES (NULL, '$charname', '$playername', '$race', '$class', 'Ready')");
    }

    function getcharacter($charid): Character
    {
        $query = $this->query(
            "SELECT PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status 
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID 
                WHERE characters.ID='$charid'
                GROUP BY charid ");
        $character = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
    }

    function addevent($sessionnumber, $description, $xpamount, $characters)
    {
        if ($sessionnumber == ''){
            $sessionnumber = 'NULL';
        }
        $this->query( "INSERT INTO `xpevents` (`ID`, `sessionnumber`, `description`, `xpamount`) VALUES (NULL, $sessionnumber, '$description', $xpamount)");
        $xpevent_id = mysqli_insert_id($this->connection);
        foreach ($characters as $character) {
            $this->query("INSERT INTO `characters_xpevents` (`character_id`, `xpevent_id`) VALUES ('$character', '$xpevent_id')");
        }
    }


    /**
     * @return Event[]
     */
    function geteventsforcharacter($charid): array
    {
        $query = $this->query(
            "SELECT xpevents.sessionnumber as sessionnumber, xpevents.description as description, xpevents.xpamount as XP, xpevents.ID as id
                FROM xpevents 
                JOIN characters_xpevents ON xpevents.ID = characters_xpevents.xpevent_id 
                WHERE characters_xpevents.character_id = $charid
                ORDER BY sessionnumber");
        $events = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects=[];
        foreach ($events as $event) {
            $objects[] = new Event($event["id"], $event["sessionnumber"], $event["description"], $event["XP"]);
        }
        return $objects;
    }

}