<?php


class FormSelect

{
    /**
     * @var Query
     */
    private $query;

        /**
     * @var Repository
     */
    private $repository;

    private $label;
    private $labelHidden;
    private $id;
    private $name;

    public function __construct($label, $labelHidden, $id, $name, Repository $repository)
    {
        $this->label = $label;
        $this->labelHidden = $labelHidden;
        $this->id = $id;
        $this->name = $name;
        $this->repository = $repository;
    }

    public function setQuery(Query $query)
    {
        return $this->query = $query;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getLabelHidden()
    {
        return $this->labelHidden;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function renderItem()
    {
        $output = '<label for="';
        $output .= $this->getLabelHidden();
        $output .= '">';
        $output .= $this->getLabel();
        $output .= ':</label><br/>';
        $output .= '<select id="';
        $output .= $this->getID();
        $output .= '" name="';
        $output .= $this->getname();
        $output .= '">';
        foreach ($this->repository->getObjectsFromQuery($this->query) as $item)
        {
            $output .= '<option value="';
            $output .= $item;
            $output .= '" >';
            $output .= $item;
            $output .= '</option>';
        }
        $output .= '</select><br/>';

        return $output;

    }


}