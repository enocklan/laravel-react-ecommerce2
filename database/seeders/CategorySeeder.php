<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =[
            [
                'name'=>'Electronics',
                'department_id'=>1,//department 1 is for electronics
                'parent_id'=>null,
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Fashion',
                'department_id'=>2,//Department 2 is for fashion
                'parent_id'=>null,
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Computers',
                'department_id'=>1,
                'parent_id'=>1,//parent is electronics
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'SmartPhones',
                'department_id'=>1 ,
                'parent_id'=>1,//parent is electronics
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            //subcategories of Computers (department 2)
            [
                'name'=>'Laptops',
                'department_id'=>1,
                'parent_id'=>3,//parent is computers
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Desktops',
                'department_id'=>1,
                'parent_id'=>3,//parent is computers
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            //subcategories of SmartPhones (department 2)
            [
                'name'=>'Android',
                'department_id'=>1,
                'parent_id'=>4,//parent is smartphones
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'iPhones',
                'department_id'=>1,
                'parent_id'=>4,//parent is smartphones
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
