<?php


class TableColumnSessionDate extends TableColumn
{
    public function renderItem($item)
    {
        return '<a href="session.php?key=' . $item->getId() . '">' . $item->getSessiondate() . '</a>';
    }

    public function __construct($title)
    {
        parent::__construct($title, '', "Session_date");
    }

}