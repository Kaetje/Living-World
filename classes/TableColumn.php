<?php


class TableColumn
{

    private $title;

    private $dataFunction;
    private $sortColumn;

    public function __construct($title, $dataFunction, $sortColumn="")
    {
        $this->title = $title;
        $this->dataFunction = $dataFunction;
        $this->sortColumn = $sortColumn;
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

    public function getSortColumn()
    {
        return $this->sortColumn;
    }


}