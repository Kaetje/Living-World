<?php


class CharacterRepository implements Repository
{
    /** @var database */
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    /**
     * @return Character[]
     */
    function getcharacters(): array
    {
        $query = $this->db->query(
            "SELECT players.PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID
                LEFT JOIN players_characters on characters.ID = players_characters.character_id
                LEFT JOIN players on players_characters.player_id = players.ID
                GROUP BY charid
                ORDER BY charname");
        $characters = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects = [];
        foreach ($characters as $character) {
            $objects[] = new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
        }
        return $objects;
    }

    function addcharacter($charname, $playername, $race, $class)
    {
        $this->db->query("INSERT INTO `characters` (`ID`, `CharacterName`, `PlayerName`, `Race`, `Class`, `Status`) VALUES (NULL, '$charname', '$playername', '$race', '$class', 'Ready')");
        $character_id = $this->db->insertID();
        $this->db->query("INSERT INTO `players_characters` (`player_id`, `character_id`) VALUES ('$playername', '$character_id')");
    }

    function getcharacter($charid): Character
    {
        $query = $this->db->query(
            "SELECT players.PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID
                LEFT JOIN players_characters on characters.ID = players_characters.character_id
                LEFT JOIN players on players_characters.player_id = players.ID
                WHERE characters.ID='$charid'
                GROUP BY charid ");
        $character = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
    }

    /**
     * @return Character[]
     */
    function getCharactersFromQuery(Query $query): array
    {
        $query = $this->db->query(
            $query->getQuery());
        $characters = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects = [];
        foreach ($characters as $character) {
            $objects[] = new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
        }
        return $objects;
    }

    function getCharactersQuery(): Query
    {
        return new Query("SELECT players.PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID
                LEFT JOIN players_characters on characters.ID = players_characters.character_id
                LEFT JOIN players on players_characters.player_id = players.ID
                GROUP BY charid");
    }


    public function getObjectsFromQuery(Query $query): array
    {
        return $this->getCharactersFromQuery($query);
    }


}