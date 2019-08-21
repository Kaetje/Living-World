<?php


class TableColumnCharName extends TableColumn
{
    public function renderItem($item)
    {
        return '<a href="charoverview.php?key='. $item->getId().'">'.$item->getCharname().'</a>';
    }

    public function __construct($title)
    {
        parent::__construct($title, '');
    }

}