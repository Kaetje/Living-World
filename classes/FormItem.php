<?php


class FormItem
{
    private $label;
    private $labelHidden;
    private $id;
    private $name;

    public function __construct($label, $labelHidden, $id, $name)
    {
        $this->label = $label;
        $this->labelHidden = $labelHidden;
        $this->id = $id;
        $this->name = $name;
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


}