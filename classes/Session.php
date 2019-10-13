<?php


class Session
{
    private $id;
    private $creationdatetime;
    // levelrange is Name from level_ranges table
    private $levelrange;
    private $mission;
    private $sessiondate;
    private $approved;
    private $initiator;
    private $buddy;
    private $marlon;
    private $players=[];

    public function __construct($id, $creationdatetime, $levelrange, $mission, $sessiondate, $approved, $initiator, $buddy, $marlon, array $players)
    {
        $this->id = $id;
        $this->creationdatetime = $creationdatetime;
        $this->levelrange = $levelrange;
        $this->mission = $mission;
        $this->sessiondate = $sessiondate;
        $this->approved = $approved;
        $this->initiator = $initiator;
        $this->buddy = $buddy;
        $this->marlon = $marlon;
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

    public function getInitiator()
    {
        return $this->initiator;
    }

    public function getBuddy()
    {
        return $this->buddy;
    }

    public function getMarlon()
    {
        return $this->marlon;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }


}