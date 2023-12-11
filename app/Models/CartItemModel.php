<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table            = 'cartitems';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['cart_id', 'book_id', 'quantity'];

    // Dates
    protected $useTimestamps = true;

    public function getItems($cartId)
    {
        return $this->where(['cart_id' => $cartId])->findAll();
    }

    public function isItemExist($cartId, $bookId)
    {
        return $this->where(['cart_id' => $cartId])->where(['book_id' => $bookId])->first();
    }

    public function getItemsId($cartId)
    {
        $items = $this->where(['cart_id' => $cartId])->findAll();
        $itemsId = array_column($items, 'book_id');

        return $itemsId;
    }
}
