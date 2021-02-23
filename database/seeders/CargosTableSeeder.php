<?php

namespace Database\Seeders;

use App\Models\Cargos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = ['Programador', 'Secretária', 'DBA'];

        foreach($cargos as $cargo){
            DB::table('cargos')->insert([
                'nome' => $cargo
            ]);
        }
    }
}
