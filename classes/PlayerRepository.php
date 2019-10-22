<?php


class PlayerRepository implements Repository
{

    /** @var database */
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    function addplayer($playername)
    {
        $this->db->query("INSERT INTO `players` (`ID`, `PlayerName`) VALUES (NULL, '$playername')");
    }

    public function getObjectsFromQuery(QueryInterface $query): array
    {
        return $this->getPlayersFromQuery($query);
    }

    /**
     * @return Player[]
     */
    function getPlayersFromQuery(QueryInterface $query): array
    {
        $query = $this->db->query(
            $query->getQuery());
        $players = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects = [];
        foreach ($players as $player) {
            $objects[] = new Player($player["playername"], $player["id"]);
        }
        return $objects;
    }

    function getPlayersQuery(): QueryInterface
    {
        return new Query("SELECT PlayerName as playername, ID as id
                FROM `players` ");
    }


}