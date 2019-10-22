<?php


class Event
{
    private $id;
    private $sessionnumber;
    private $description;
    private $XP;
    private $characternames = [];

    public function __construct($id, $sessionnumber, $description, $XP, array $characternames = [])
    {
        $this->id = $id;
        $this->sessionnumber = $sessionnumber;
        $this->description = $description;
        $this->XP = $XP;
        $this->characternames = $characternames;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSessionnumber()
    {
        return $this->sessionnumber;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getXP()
    {
        return $this->XP;
    }

    public function getCharacternames(): array
    {
        return $this->characternames;
    }


}