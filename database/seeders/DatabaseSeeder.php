<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BloodTableSeeder;
use Database\Seeders\religionTableSeeder;
use Database\Seeders\NationalitiesTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(religionTableSeeder::class);
    }
}