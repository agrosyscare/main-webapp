<?php

use App\EnvironmentalCondition;
use Illuminate\Database\Seeder;

class EnvironmentalConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnvironmentalCondition::create(['name' => 'Temperatura']);
        EnvironmentalCondition::create(['name' => 'Humedad Ambiental']);
        EnvironmentalCondition::create(['name' => 'Humedad Radicular']);
    }
}
