<?php

namespace Admin\Component;

class ItemList implements GenericListComponentInterface
{
    private $items;
    private $genericList;

    public function __construct($items, GenericList $genericList)
    {
        $this->items = $items;
        $genericList->setListComponent($this);
        $this->genericList = $genericList;
    }

    public function getData()
    {
        return $this->items ? $this->items : [];
    }

    public function getColumns()
    {
        return [
            'cb' => '<input type="checkbox" />',
            'id' => __('ID'),
            'name' => __('Name'),
            'duration' => __('Duration'),
            'price' => __('Price'),
            'extras' => __('Extras')
        ];
    }

    public function display()
    {
        $this->genericList->renderFullList();
    }

    public function getCheckboxColumn($item)
    {
        return sprintf(
            '<input type="checkbox" name="element[]" value="%s" />',
            $item['id']
        );
    }

    public function getColumnDefault($item, $columnName)
    {
        switch ($columnName) {
            case 'id':
            case 'name':
            case 'duration':
            case 'price':
            case 'extras':
            default:
                return $item[$columnName];
        }
    }

    public function getSortableColumns()
    {
        return [
            'id' => ['id', true],
            'name' => ['name', true],
            'duration' => ['duration', true],
            'price' => ['price', true],
            'extras' => ['extras', true]
        ];
    }
}