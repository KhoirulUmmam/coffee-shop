<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'initial' => 'CS',
            'description' => 'Coffee Shop adalah suatu perusahaan kopi yang menggunakan mesin.',
            'name' => 'CoffeeShop',
            'address' => 'Jl. Jendral Sudirman',
            'province' => 'Jawa Barat',
            'city' => 'Bandung',
            'postal_code' => '40004',
            'web' => 'coffeeshop.com',
            'email' => 'cs@gmail.com',
            'telephone' => '082128934640',
            'fax' => '082128934640',
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ]);
    }
}
