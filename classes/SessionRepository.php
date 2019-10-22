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
        return new Query("
                            select sessions.ID as id, Creation_datetime as creationdatetime, level_ranges.Name as levelrange, Mission as mission, Session_date as sessiondate, Stamp_of_approval as approved, COALESCE(p1.PlayerName, \"\") as initiator, COALESCE(p2.PlayerName, \"\") as buddy, COALESCE(p3.PlayerName, \"\") as marlon, COALESCE(p4.PlayerName, \"\") as players
                            from sessions
                            left join sessions_players sp1 on sessions.ID = sp1.SessionID and sp1.rol = 1
                            left join players p1 on sp1.playerID = p1.ID
                            left join sessions_players sp2 on sessions.ID = sp2.SessionID and sp2.rol = 2
                            left join players p2 on sp2.playerID = p2.ID
                            left join sessions_players sp3 on sessions.ID = sp3.SessionID and sp3.rol = 3
                            left join players p3 on sp3.playerID = p3.ID
                            left join sessions_players sp4 on sessions.ID = sp4.SessionID and sp4.rol = 4
                            left join players p4 on sp4.playerID = p4.ID
                            LEFT JOIN level_ranges on Level_rangeID = level_ranges.ID
                                    GROUP BY sessions.ID
                                    ORDER BY Session_date
                            ");
    }

    public function getObjectsFromQuery(Query $query): array
    {
        return $this->getSessionsFromQuery($query);
    }

    function approveSession ($id)
    {
        $this->db->query( "UPDATE `sessions` SET `Stamp_of_approval`= '1' WHERE `ID` = $id");
    }
}