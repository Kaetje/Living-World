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
     * @var Repository
     */
    private $repository;

    public function __construct(string $url, Repository $repository)
    {
        $this->url = $url;
        $this->repository = $repository;
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
        foreach ($this->repository->getObjectsFromQuery($this->query) as $item){
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

