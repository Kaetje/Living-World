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
        $this->db->query( "INSERT INTO `sessions` (`ID`, `Creation_datetime`, `Level_rangeID`, `Mission`, `Session_date`) VALUES (NULL, CURRENT_TIMESTAMP, $levelrange, '$mission', '$sessiondate')");
        $session_id = $this->db->insertID();
        $this->db->query("INSERT INTO `sessions_players` (`playerID`, `sessionID`, `rol`) VALUES ('$initiator', '$session_id', '1')");
        $this->db->query("INSERT INTO `sessions_players` (`playerID`, `sessionID`, `rol`) VALUES ('$buddy', '$session_id', '2')");
    }

    /**
     * @return Session[]
     */
    function getSessionsFromQuery(Query $query): array
    {
        $query = $this->db->query(
            $query->getQuery());
        $sessions = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $objects=[];
        foreach ($sessions as $session) {
            $objects[] = new Session($session["id"], $session["creationdatetime"], $session["levelrange"], $session["mission"], $session["sessiondate"], $session["approved"], $session["initiator"], $session["buddy"], $session["marlon"], $session["players"]);
        }
        return $objects;
    }

    function getSessionsQuery(): Query
    {
        return new Query("SELECT sessions.ID as id, Creation_datetime as creationdatetime, level_ranges.Name as levelrange, Mission as mission, Session_date as sessiondate, Stamp_of_approval as approved
                                    FROM sessions
                                    LEFT JOIN level_ranges on Level_rangeID = level_ranges.ID
                                    GROUP BY sessions.ID");
    }


    public function getObjectsFromQuery(Query $query): array
    {
        return $this->getSessionsFromQuery($query);
    }
}