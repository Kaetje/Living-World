<?php


class TableColumn
{

    private $title;

    private $dataFunction;

    public function __construct($title, $dataFunction)
    {
        $this->title = $title;
        $this->dataFunction = $dataFunction;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDataFunction()
    {
        return $this->dataFunction;
    }

    public function renderItem($item)
    {
        return call_user_func([$item,$this->dataFunction]);
    }


}