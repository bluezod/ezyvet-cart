<?php
/**
 * Created by PhpStorm.
 * User: bluezod
 * Date: 2018-12-11
 * Time: 21:27
 */

class Cart
{
    protected $items = [];

    public function getItems()
    {
        return $this->items;
    }

    public function add($name, $price)
    {

    }

    public function remove($name)
    {

    }

    public function getItemQty($name)
    {

    }

    public function getItemTotal($name)
    {

    }

    public function getOverallTotal()
    {

    }

    public function isEmpty()
    {
        return empty($this->items);
    }
}
