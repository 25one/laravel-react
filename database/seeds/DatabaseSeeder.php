<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Size;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'name' => 'Костюм "Лора"',
                'price' => '19.99',
                'image' => 'product_1.jpg',
                'top9' => 1,
            ]
        ); 
        Product::create(
            [
                'name' => 'Костюм "Кимоно"',
                'price' => '22.99',
                'image' => 'product_2.jpg',
                'top9' => 1,
            ]
        );  
        Product::create(
            [
                'name' => 'Блуза "Бриз"',
                'price' => '7.99',
                'image' => 'product_3.jpg',
                'top9' => 1,
            ]
        ); 

        Comment::create(
            [
                'user_id' => 63, //!!!see real id
                'product_id' => 3,
                'comment' => "admin's comment of product_3",
            ]
        ); 
        Comment::create(
            [
                'user_id' => 64, //!!!see real id
                'product_id' => 3,
                'comment' => "user's comment of product_3",
            ]
        );  
        Comment::create(
            [
                'user_id' => 63, //!!!see real id
                'product_id' => 8,
                'comment' => "admin's comment of product_8",
            ]
        ); 
        
        Size::create(
            [
                'name' => 'XS',
            ]
        ); 
        Size::create(
            [
                'name' => 'S',
            ]
        );   
        Size::create(
            [
                'name' => 'M',
            ]
        ); 
        Size::create(
            [
                'name' => 'L',
            ]
        ); 
        Size::create(
            [
                'name' => 'XL',
            ]
        ); 
        Size::create(
            [
                'name' => 'XXL',
            ]
        );                                      
    }
}
