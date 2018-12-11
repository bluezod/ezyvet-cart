<?php
/**
 * Created by PhpStorm.
 * User: bluezod
 * Date: 2018-12-11
 * Time: 21:27
 */

class Cart
{
    protected $items = array();

    public function __construct(array $items = array())
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function add($name, $price)
    {
        $qty = 1;
        try {
            if (isset($this->items[$name])) {
                $qty += $this->items[$name]['qty'];
            }
            $rowTotal = number_format(round($price * $qty, 2), 2);
            $this->items[$name] = array(
                'name' => $name,
                'unit_price' => $price,
                'qty' => $qty,
                'row_total' => $rowTotal,
            );
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }

    public function remove($name)
    {
        try {
            if (isset($this->items[$name])) {
                unset($this->items[$name]);
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }

    public function getOverallTotal()
    {
        $grandTotal = 0;
        foreach ($this->items as $item) {
            $grandTotal += $item['row_total'];
        }
        return number_format(round($grandTotal, 2), 2);
    }

    public function isEmpty()
    {
        return empty($this->items);
    }
}
