<?php


class Player
{
    private $playername;
    private $id;

    public function __construct($playername, $id)
    {
        $this->playername = $playername;
        $this->id = $id;
    }

    public function getPlayername()
    {
        return $this->playername;
    }

    public function getId()
    {
        return $this->id;
    }


}