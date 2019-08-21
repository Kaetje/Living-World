<?php


class Table
{
    /** @var TableColumn[]  */
    private $columns=[];

    private $data=[];

    public function addColumn(TableColumn $column){
        $this->columns[] = $column;
    }

    public function addData(array$data){
        $this->data = $data;
    }

    public function render():string {
        $output = '';
        $output .= '<table>';
        $output .= '<tr>';
        foreach ($this->columns as $column){
            $output .= '<th>'.$column->getTitle().'</th>';
        }
        $output .= '</tr>';
        foreach ($this->data as $item){
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

