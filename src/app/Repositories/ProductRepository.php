<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{	
    private $product;

    public function __construct(
        Product $product
    )
    {
        $this->product = $product;
    }

    public function available(){
        
        $products = $this->product->where('availability', 1)->get();

        return $products;
    }

    public function getById($id){
        
        $products = $this->product->where('id', $id)->first();

        return $products;
    }

    public function getCategories(){

        $categories = $this->product->select('category')->groupBy('category')->get();

        return $categories;
    }

    public function getCategoriesByWarehouse($warehouse_id){

        $categories = $this->product->where('warehouse_id', $warehouse_id)->select('category')->groupBy('category')->get();

        return $categories;
    }

    public function getByCategoryAndWarehouse($category, $warehouse_id){
        
        $products = $this->product->where('availability', 1)->where('warehouse_id', $warehouse_id)->where('category', $category)->get();

        return $products;
    }
}