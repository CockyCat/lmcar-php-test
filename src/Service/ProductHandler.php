<?php

namespace App\Service;

class ProductHandler
{
    public static function calculatePrice($products){
        $totalPrice = 0;
        if (!count($products) > 0){
            return $totalPrice;
        }
        foreach ($products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }
        return $totalPrice;
    }

    public static function sortByPrice($products){
        if (!count($products) > 0){
            return array();
        }
        //filted type acccording by type
        foreach ($products as $key => $product){
            if ($product['type'] != "Dessert"){
                unset($products[$key]);
            }
        }
        array_multisort(array_column($products, 'price'),SORT_DESC,$products);
        return $products;
    }

    public static function convertDateToTimestamp($products){
        if (!count($products) > 0){
            return array();
        }
        //filted type acccording by type
        foreach ($products as $key => $product){
            $products[$key]["create_at_timestamp"] = strtotime($product["create_at"]);
        }
        return $products;
    }
}