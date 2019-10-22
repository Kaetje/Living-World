<?php
declare(strict_types=1);

class PriorityPlayerQuery implements QueryInterface
{
    /** @var database */
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    private function getForbiddenSessions()
    {
        $rows = mysqli_fetch_all(
            $this->db->query(
                "SELECT ID FROM sessions ORDER BY Session_date DESC LIMIT 3"
            ),
            MYSQLI_ASSOC
        );
        $ids = [];
        foreach ($rows as $row) {
            $ids[] = $row['ID'];
        }
        return $ids;
    }

    public function getQuery()
    {
        $ids = $this->getForbiddenSessions();
        if (!$ids) {
            return "SELECT PlayerName as playername, ID as id FROM `players`";
        }
        $where = ' WHERE session_id IN ($idsString) ' . implode(', ', $ids);
        return "SELECT PlayerName as playername, ID as id
                FROM `players` WHERE ID NOT IN (
                    SELECT player_id FROM session_players $where  
                )";
    }
}
