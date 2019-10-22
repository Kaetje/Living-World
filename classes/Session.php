<?php


class Session
{
    private $id;
    private $creationdatetime;
    private $levelrange;
    private $mission;
    private $sessiondate;
    private $approved;
    private $players = [];

    public function __construct($id, $creationdatetime, $levelrange, $mission, $sessiondate, $approved, array $players)
    {
        $this->id = $id;
        $this->creationdatetime = $creationdatetime;
        $this->levelrange = $levelrange;
        $this->mission = $mission;
        $this->sessiondate = $sessiondate;
        $this->approved = $approved;
        $this->players = $players;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreationdatetime()
    {
        return $this->creationdatetime;
    }

    public function getLevelrange()
    {
        return $this->levelrange;
    }

    public function getMission()
    {
        return $this->mission;
    }

    public function getSessiondate()
    {
        return $this->sessiondate;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function getPlayers()
    {
        $objects = [];
        foreach ($this->players as $player) {
            if ($player['rol'] > 2) {
                $objects[] = $player['playerName'];
            }
        }
        return implode(', ', $objects);
    }

    public function getInitiator()
    {
        foreach ($this->players as $player) {
            if ($player['rol'] == 1) {
                return $player['playerName'];
            }
        }
        return 'The Dungeon Master';
    }

    public function getBuddy()
    {
        foreach ($this->players as $player) {
            if ($player['rol'] == 2) {
                return $player['playerName'];
            }
        }
        return '';
    }

    public function hasPriority(): bool
    {
        $sessionTime = new DateTimeImmutable($this->getCreationdatetime());
        return $sessionTime > new DateTimeImmutable('-3 days');
    }
}