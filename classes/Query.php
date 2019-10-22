<?php


class Query implements QueryInterface
{
    private $baseSql;
    private $column;
    private $direction;

    public function __construct($baseSql)
    {
        $this->baseSql = $baseSql;
    }

    public function addOrderBy($column, $direction = 'ASC')
    {
        $this->column = $column;
        $this->direction = $direction;
    }

    public function getQuery()
    {
        $sql = $this->baseSql;
        if ($this->column) {
            $sql .= ' ORDER BY ' . $this->column . ' ' . $this->direction;
        }
        return $sql;
    }

}