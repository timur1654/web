<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'лазерные принтеры',
            'струйные принтеры',
            'термопринтеры',
        ];

        foreach ($categories as $category){
            Category::create(['name' => $category]);
        }

        User::insert([
            'name' => 'Администратор',
            'surname' => 'Портала',
            'patronymic' => '',
            'login' => 'admin',
            'email' => 'admi@example.com',
            'password' => 'admin1234',
            'isAdmin' => 1,
        ]);

        User::insert([
            'name' => 'Иван',
            'surname' => 'Иванов',
            'patronymic' => '',
            'login' => 'user1',
            'email' => 'user@example.com',
            'password' => 'ivan1234',
        ]);

        Product::insert([
            'category_id' => 1,
            'name' => 'Принтер новый',
            'image' => 'weFRoijfH0tpdaulaP8rGhVwpFRVWGnBNkJCvGq6.jpg',
            'country' => 'Беларусь',
            'price' => 1200,
            'count' => 30,
            'description' => 'Новый принтер',
        ]);
        Product::insert([
            'category_id' => 2,
            'name' => 'Притер эликтрический',
            'image' => 'weFRoijfH0tpdaulaP8rGhVwpFRVWGnBNkJCvGq6.jpg',
            'country' => 'Россия',
            'price' => 2000,
            'count' => 100,
            'description' => 'Принтер красивый',
        ]);
        Product::insert([
            'category_id' => 3,
            'name' => 'Принтер лазерный',
            'image' => 'weFRoijfH0tpdaulaP8rGhVwpFRVWGnBNkJCvGq6.jpg',
            'country' => 'Италия',
            'price' => 2500,
            'count' => 80,
            'description' => 'Принтер прямиком из Италии',
        ]);

        Status::insert([
            'status_name' => 'Новый'
        ]);

        Status::insert([
            'status_name' => 'Подтвержден'
        ]);

        Status::insert([
            'status_name' => 'Отменен'
        ]);
    }
}
