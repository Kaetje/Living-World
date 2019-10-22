<?php


class EventRepository implements Repository
{
    /** @var database */
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    function addevent($sessionnumber, $description, $xpamount, $characters)
    {
        if ($sessionnumber == '') {
            $sessionnumber = 'NULL';
        }
        $this->db->query("INSERT INTO `xpevents` (`ID`, `sessionnumber`, `description`, `xpamount`) VALUES (NULL, $sessionnumber, '$description', $xpamount)");
        //$xpevent_id = mysqli_insert_id($this->connection);
        $xpevent_id = $this->db->insertID();
        foreach ($characters as $character) {
            $this->db->query("INSERT INTO `characters_xpevents` (`character_id`, `xpevent_id`) VALUES ('$character', '$xpevent_id')");
        }
    }


    /**
     * @return Event[]
     */
    function getEventsFromQuery(Query $query): array
    {
        $query = $this->db->query(
            $query->getQuery());
        $events = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects = [];
        foreach ($events as $event) {
            $objects[] = new Event($event["id"], $event["sessionnumber"], $event["description"], $event["XP"]);
        }
        return $objects;
    }

    function getEventsQuery($charid): Query
    {
        return new Query("SELECT xpevents.sessionnumber as sessionnumber, xpevents.description as description, xpevents.xpamount as XP, xpevents.ID as id
                FROM xpevents 
                JOIN characters_xpevents ON xpevents.ID = characters_xpevents.xpevent_id 
                WHERE characters_xpevents.character_id = $charid");
    }

    function getObjectsFromQuery(Query $query): array
    {
        return $this->getEventsFromQuery($query);
    }
}