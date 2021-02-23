<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscolaridadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escolaridades = ['2° grau completo', 'Cursando Superior', 'Superior Completo', 'Mestrado'];

        foreach($escolaridades as $escolaridade){
            DB::table('escolaridade')->insert([
                'nome' => $escolaridade
            ]);
        }
    }
}
