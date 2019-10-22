<?php


class Character
{
    private $playername;
    private $charname;
    private $race;
    private $class;
    private $XP;
    private $status;
    private $id;


    public function __construct($id, $playername, $charname, $race, $class, $XP, $status)
    {
        $this->id = $id;
        $this->playername = $playername;
        $this->charname = $charname;
        $this->race = $race;
        $this->class = $class;
        $this->XP = (int)$XP;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getPlayerName()
    {
        return $this->playername;
    }

    public function getCharname()
    {
        return $this->charname;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getXP()
    {
        return $this->XP;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLevel()
    {
        if ($this->XP < 300) {
            return 1;
        }
        if ($this->XP < 900) {
            return 2;
        }
        if ($this->XP < 2700) {
            return 3;
        }
        if ($this->XP < 6500) {
            return 4;
        }
        if ($this->XP < 14000) {
            return 5;
        }
        if ($this->XP < 23000) {
            return 6;
        }
        if ($this->XP < 34000) {
            return 7;
        }
        if ($this->XP < 48000) {
            return 8;
        }
        if ($this->XP < 64000) {
            return 9;
        }
        if ($this->XP < 85000) {
            return 10;
        }
        if ($this->XP < 100000) {
            return 11;
        }
        if ($this->XP < 120000) {
            return 12;
        }
    }

}