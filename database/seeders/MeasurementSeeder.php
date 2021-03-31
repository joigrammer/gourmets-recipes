<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Cucharadita',
                'abbrev' => 'cdta.'
            ],
            [
                'name' => 'Cucharada',
                'abbrev' => 'cda.'
            ],

            [
                'name' => 'Gramo',
                'abbrev' => 'grs.'
            ],
            [
                'name' => 'Kilogramo',
                'abbrev' => 'kg.'
            ],
            [
                'name' => 'Libra',
                'abbrev' => 'lb.'
            ],
            [
                'name' => 'Litro',
                'abbrev' => 'lt.'
            ],
            [
                'name' => 'Onza',
                'abbrev' => 'oz.'
            ],
            [
                'name' => 'Taza',
                'abbrev' => 'tz.'
            ]
        ];
        Measurement::insert($data);
    }
}
