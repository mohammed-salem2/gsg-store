<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ORM : Eloquent Model
        Category::create([
            'name'=>'My First Category',
            'slug'=>'my-first-category',
        ]);
        Category::create([
            'name'=>'Sub Category',
            'slug'=>'sub-category',
        ]);
        //Query Builder
        // DB::connection('mysql')->table('categories')->insert([
        //     'name'=>'My First Category',
        //     'slug'=>'my-first-category',
        // ]);
        // DB::connection('mysql')->table('categories')->insert([
        //     'name'=>'Sub Category',
        //     'slug'=>'sub-category',
        //     'parent_id'=>1,
        // ]);
        //Sql Command
    }
}
