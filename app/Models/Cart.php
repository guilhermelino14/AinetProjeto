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

    public function add($item, $id , $qty, $tamanho, $cor){
        $preco = Preco::find(1);
        if($item->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
        }
            
        $storedItem = ['id' => 0,'qty' => 0, 'price' => $price, 'item' => $item, 'tamanho' => $tamanho, 'cor' => $cor];
        $itemIndex = 0;
        if($this->items){
            $itemIndex = count($this->items);
            for($index = 0; $index <= count($this->items); $index++){
                if($item[$index]['id'] == $id && $item[$index]['tamanho'] == $tamanho && $item[$index]['cor'] == $cor){
                    $storedItem = $item[$index];
                    $itemIndex = $index;
                    $index = count($this->items);
                }
            }
        }

        $storedItem['id']= $id;
        $storedItem['qty']+= $qty;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$itemIndex] = $storedItem;
    }

    public function remove($index){
        $storedItem = $this->items[$index];
        $estampa = Estampa::find($storedItem['id']);

        $preco = Preco::find(1);
        if($estampa->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
        }

        $storedItem['qty']--;
        $storedItem['price'] = $price * $storedItem['qty'];
        unset($this->items[$index]);
    }

    public function editQuantity($index, $operator){
        $storedItem = $this->items[$index];
        $estampa = Estampa::find($storedItem['id']);

        $preco = Preco::find(1);
        if($estampa->cliente_id == null){
            $price = $preco->preco_un_catalogo;
        }
        else{
            $price = $preco->preco_un_proprio;
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
        $this->items[$index] = $storedItem;
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