<?php


class Table
{
    /** @var TableColumn[]  */
    private $columns=[];

    /**
     * @var Query
     */
    private $query;

    private $url;

    /**
     * @var database
     */
    private $database;

    public function __construct(string $url, database $database)
    {
        $this->url = $url;
        $this->database = $database;
    }


    public function addColumn(TableColumn $column){
        $this->columns[] = $column;
    }

    public function setQuery(Query $query){
        $this->query = $query;
    }

    public function render():string {
        if (isset($_GET['column'])){$this->query->addOrderBy($_GET['column'], $_GET['direction']);}

        $output = '';
        $output .= '<table>';
        $output .= '<tr>';
        foreach ($this->columns as $column){
            $output .= '<th>'.$column->getTitle().'<a href="'.$this->url.'&column='.$column->getSortColumn().'&direction=asc">order ascending</a></th>';
        }
        $output .= '</tr>';
        foreach ($this->database->getEventsFromQuery($this->query) as $item){
            $output .= '<tr>';
            foreach ($this->columns as $column){
                $output .= '<td>'.$column->renderItem($item).'</td>';
            }
            $output .= '</tr>';
        }

        $output .= '</table>';
        return $output;
    }

}

