<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = \App\Models\Page::create([
            'name' => 'About',
            'slug' => 'about',
            'content' => 'This is about page',
        ]);
    }
}
