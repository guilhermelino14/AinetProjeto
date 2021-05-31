<?php

namespace App\Models;

class Cart
{
    public $items = null;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
        }
    }

    public function add($item, $id){
        $preco = Preco::find(1);
        if($item->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
        }
            
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
    }

    public function remove($item, $id){
        $preco = Preco::find(1);
        if($item->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
        }
            
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']--;
        $storedItem['price'] = $price * $storedItem['qty'];
        unset($this->items[$id]);
    }

    public function editQuantity($item, $id, $operator){
        $preco = Preco::find(1);
        if($item->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
        }
            
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        if($operator == '+'){
            $storedItem['qty']++;
        }
        else{
            if($storedItem['qty'] > 1){
                $storedItem['qty']--;
            }
        }
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
    }

    public function totalPrice(){
        $totalPrice = 0;
        foreach($this->items as $item){
           $totalPrice += $item['price'];
        }
        return $totalPrice;
    }

    public function totalQty(){
        $totalQty = 0;
        foreach($this->items as $item){
           $totalQty += $item['qty'];
        }
        return $totalQty;
    }
}