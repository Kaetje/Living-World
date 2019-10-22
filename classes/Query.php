<?php


class Query
{
    private $baseSql;
    private $column;
    private $direction;

    public function __construct($baseSql)
    {
        $this->baseSql = $baseSql;
    }

    public function addOrderBy($column, $direction)
    {
        $this->column = $column;
        $this->direction = $direction;
    }

    public function getQuery()
    {
        if ($this->column) {
            return $this->baseSql . ' ORDER BY ' . $this->column . ' ' . $this->direction;
        }
        return $this->baseSql;
    }

}