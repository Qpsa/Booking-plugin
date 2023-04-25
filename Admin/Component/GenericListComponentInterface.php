<?php

namespace Admin\Component;

interface GenericListComponentInterface
{
    public function getData();

    public function getColumns();

    public function display();

    public function getCheckboxColumn($item);

    public function getColumnDefault($item, $columnName);

    public function getSortableColumns();
}