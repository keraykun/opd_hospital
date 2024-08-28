<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::create([
            'name'=>'ABDOMEN CROSS TABLE LATERAL',
            'cost'=>200.00
        ]);
        Services::create([
            'name'=>'ABDOMEN LATERAL VIEW',
            'cost'=>200.00
        ]);
        Services::create([
            'name'=>'ABDOMEN-AP(FLAT PLATE)',
            'cost'=>200.00
        ]);
        Services::create([
            'name'=>'ABDOMEN-AP(UPRIGHT)',
            'cost'=>300.00
        ]);
        Services::create([
            'name'=>'ABDOMEN-AP(HEAD)',
            'cost'=>200.00
        ]);
    }
}
