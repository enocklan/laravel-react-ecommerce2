<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $departments = [
                [
                    'name' => 'Electronics',
                    'slug' => 'electronics',
                    'meta_title' => 'Shop Electronics Online',
                    'meta_description' => 'Explore top electronics including phones, laptops, TVs and more at unbeatable prices.',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Fashion',
                    'slug' => 'fashion',
                    'meta_title' => 'Latest Fashion Trends',
                    'meta_description' => 'Discover trending fashion for men, women, and kids. Stay stylish with our newest collections.',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Home, Garden & Tools',
                    'slug' => Str::slug('Home, Garden & Tools'),
                    'meta_title' => 'Home, Garden & Tools Store',
                    'meta_description' => 'Upgrade your home and garden with our range of tools, décor, and furniture.',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Health & Beauty',
                    'slug' => Str::slug('Health & Beauty'),
                    'meta_title' => 'Health & Beauty Products',
                    'meta_description' => 'Shop skincare, wellness, and grooming essentials for your health and beauty needs.',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ],


        ];
        DB::table('departments')->insert($departments);

    }
}
