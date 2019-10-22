<?php


class SessionRepository implements Repository
{
    /** @var database */
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    function addsession($initiator, $sessiondate, $levelrange, $mission, $buddy)
    {
        $this->db->query("INSERT INTO `sessions` (`ID`, `Creation_datetime`, `Level_rangeID`, `Mission`, `Session_date`) VALUES (NULL, CURRENT_TIMESTAMP, $levelrange, '$mission', '$sessiondate')");
        $session_id = $this->db->insertID();
        $this->db->query("INSERT INTO `sessions_players` (`playerID`, `sessionID`, `rol`) VALUES ('$initiator', '$session_id', '1')");
        $this->db->query("INSERT INTO `sessions_players` (`playerID`, `sessionID`, `rol`) VALUES ('$buddy', '$session_id', '2')");
    }

    /**
     * @return Session[]
     */
    function getSessionsFromQuery(QueryInterface $query): array
    {
        $query = $this->db->query(
            $query->getQuery());
        $sessions = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects = [];
        foreach ($sessions as $session) {
            $session["players"] = mysqli_fetch_all($this->db->query('
                    Select playerID as playerID, rol as rol, players.PlayerName as playerName
                    from sessions_players
                    LEFT JOIN players on sessions_players.playerID = players.ID
                    WHERE sessionID = '.$session["id"].'
                    GROUP By playerID
                '), MYSQLI_ASSOC);
            $objects[] = new Session($session["id"], $session["creationdatetime"], $session["levelrange"], $session["mission"], $session["sessiondate"], $session["approved"], $session["players"]);
        }
        return $objects;
    }

    function getSessionsQuery($id = null): Query
    {
        $where = '';
        if ($id) {
            $where = 'WHERE sessions.ID = ' . (int) $id;
        }
        return new Query("
                            select sessions.ID as id, Creation_datetime as creationdatetime, level_ranges.Name as levelrange, Mission as mission, Session_date as sessiondate, Stamp_of_approval as approved
                            from sessions
                            LEFT JOIN level_ranges on Level_rangeID = level_ranges.ID
                            $where
                                    GROUP BY sessions.ID
                                    ORDER BY Session_date
                            ");
    }

    public function getObjectsFromQuery(QueryInterface $query): array
    {
        return $this->getSessionsFromQuery($query);
    }

    function approveSession($id)
    {
        $this->db->query("UPDATE `sessions` SET `Stamp_of_approval`= '1' WHERE `ID` = $id");
    }

    function addPlayer($id, $player)
    {
        $this->db->query("INSERT INTO `sessions_players` (`playerID`, `sessionID`, `rol`) VALUES ('$player', '$id', '4')");
    }
}