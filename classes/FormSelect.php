<?php


class FormSelect

{

    private $label;
    private $id;
    private $name;
    /**
     * @var array
     */
    private $items;

    public function __construct($label, $id, $name, array $items)
    {
        $this->label = $label;
        $this->id = $id;
        $this->name = $name;
        $this->items = $items;
    }

    public function getLabel()
    {
        return $this->label;
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
        $output .= $this->getId();
        $output .= '">';
        $output .= $this->getLabel();
        $output .= ':</label><br/>';
        $output .= '<select id="';
        $output .= $this->getID();
        $output .= '" name="';
        $output .= $this->getname();
        $output .= '">';
        $output .= '<option value="-"></option>';
        foreach ($this->items as $key => $item) {
            $output .= '<option value="';
            $output .= $key;
            $output .= '" >';
            $output .= $item;
            $output .= '</option>';
        }
        $output .= '</select><br/>';

        return $output;
    }

    public function playerList($label, $id, $name)
    {
        $database = new database();
        $playerRepository = new PlayerRepository($database);
        $playersQuery = $playerRepository->getPlayersQuery();
        $playerObjects = $playerRepository->getPlayersFromQuery($playersQuery);
        $formSelectDataPlayer = [];
        foreach ($playerObjects as $playerObject) {
            $formSelectDataPlayer[$playerObject->getId()] = $playerObject->getPlayername();
        }
        $initiator = new FormSelect($label, $id, $name, $formSelectDataPlayer);
        echo $initiator->renderItem();
    }

}