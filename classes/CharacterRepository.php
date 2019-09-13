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
        $this->db->query( "INSERT INTO `characters` (`ID`, `CharacterName`, `PlayerName`, `Race`, `Class`, `Status`) VALUES (NULL, '$charname', '$playername', '$race', '$class', 'Ready')");
    }

    function getcharacter($charid): Character
    {
        $query = $this->db->query(
            "SELECT PlayerName as playername, CharacterName as charname, SUM(xpevents.xpamount) as XP, characters.ID as charid, Race as race, Class as class, Status as status 
                FROM `characters` 
                LEFT JOIN characters_xpevents on characters.ID = characters_xpevents.character_id 
                LEFT JOIN xpevents on characters_xpevents.xpevent_id = xpevents.ID 
                WHERE characters.ID='$charid'
                GROUP BY charid ");
        $character = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return new Character($character["charid"], $character["playername"], $character["charname"], $character["race"], $character["class"], $character["XP"], $character["status"]);
    }

    public function getObjectsFromQuery(Query $query): array
    {
        return $this->getcharacters();
    }


}