<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ['INICIADA','EN PROCESO','CANCELADA','COMPLETADA'];
        foreach($states as $state){
            DB::table('states')->insert(['name' => $state]);
        }
    }
}
