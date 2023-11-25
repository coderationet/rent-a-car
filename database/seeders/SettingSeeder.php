<?php

namespace Database\Seeders;

use App\Helpers\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::update('site_title', 'Rent A Car System','yes');

        Option::autoload();

    }
}
