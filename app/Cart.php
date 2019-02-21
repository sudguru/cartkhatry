<?php

namespace App;

class Cart {
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'rate' => $item->rate, 'item' => $item];
        if($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];   
            }
        }
        $addedPrice = $item->qty * $item->rate;
        $storedItem['qty'] += $item->qty;
        $storedItem['price'] = $item->rate * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $item->qty;
        $this->totalPrice += $addedPrice;
    }

    public function remove($id) {
        $thisqty = $this->items[$id]['qty'];
        $this->totalQty = $this->totalQty - $thisqty;
        $this->totalPrice = $this->totalPrice - $this->items[$id]['price'];
        unset($this->items[$id]);
        // dd($this->items);
    }
    
}
