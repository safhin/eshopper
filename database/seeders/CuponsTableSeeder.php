<?php

namespace Database\Seeders;

use App\Models\Cupon;
use Illuminate\Database\Seeder;

class CuponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cupon::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 30
        ]);
        Cupon::create([
            'code' => 'DEF456',
            'type' => 'percent',
            'percent_off' => 50
        ]);
    }
}
