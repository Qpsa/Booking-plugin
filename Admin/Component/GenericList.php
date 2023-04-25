<?php

namespace Admin\Component;

use Utils\WebParam;

class GenericList extends \WP_List_Table
{
    /**
     * @var GenericListComponentInterface
     */
    private $listComponent;

    public function setListComponent(GenericListComponentInterface $listComponent)
    {
        $this->listComponent = $listComponent;
    }

    public function renderFullList()
    {
        ?>
        <div class="wrap">
            <form method="post">
            <?php
            $this->prepare_items();
            // Search form
            $this->search_box('search', 'search_id');
            //display table
            $this->display();
            ?>
            </form>
        </div>
        <?php
    }

    // Define table columns
    public function get_columns()
    {
        return $this->listComponent->getColumns();
    }

    public function column_cb($item)
    {
        return $this->listComponent->getCheckboxColumn($item);
    }

    public function column_default($item, $column_name)
    {
        return $this->listComponent->getColumnDefault($item, $column_name);
    }

    protected function get_sortable_columns()
    {
        return $this->listComponent->getSortableColumns();
    }

    // Sorting function
    function usort_reorder($a, $b)
    {
        // If no sort, default to id
        $orderby = (!empty(WebParam::get('orderby'))) ? WebParam::get('orderby') : 'id';

        // If no order, default to asc
        $order = (!empty(WebParam::get('orderby'))) ? WebParam::get('orderby') : 'desc';

        // Determine sort order
        $result = (int)$a[$orderby] - (int)$b[$orderby];
//        $result = strcmp($a[$orderby], $b[$orderby]);

        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }

    // Bind table with columns, data and all
    public function prepare_items()
    {
        $data = $this->listComponent->getData();

        $columns = $this->get_columns();
        $hidden = (is_array(get_user_meta(get_current_user_id(),
            'tablecolumnshidden', true))) ? get_user_meta(get_current_user_id(),
            'tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        usort($data, array(&$this, 'usort_reorder'));


        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 15);
        $current_page = $this->get_pagenum();
        $total_items = count($data);

        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page);

        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page' => $per_page, // items to show on a page
            'total_pages' => ceil($total_items / $per_page) // use ceil to round up
        ));


        $this->items = $data;
    }
}