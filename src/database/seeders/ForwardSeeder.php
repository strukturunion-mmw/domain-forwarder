<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Forward;

class ForwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert a degault and a sample Route
        Forward::insert([
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'name' => 'Default Route',
                'request' => 'default',
                'target' => 'https://www.strukturunion.de'
            ],
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'name' => 'Sample Route',
                'request' => 'www.i-like-doodles.com',
                'target' => 'https://www.google.com/doodles'
            ]
        ]);
    }
}
