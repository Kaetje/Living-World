<?php


class TableColumnBoolean extends TableColumn
{
    public function renderItem($item)
    {
        if (parent::renderItem($item)) {
            return "Yes";
        } else {
            return "No";
        }
    }

}