<?php


class SessionRepository
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
}