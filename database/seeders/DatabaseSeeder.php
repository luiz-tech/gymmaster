<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Alunos;
use App\Models\Contatos;
use App\Models\Enderecos;
use App\Models\Instrutores;
use App\Models\Pessoas;
use App\Models\Planos;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //criação de resgistros de testes
    public function run()
    {
        Alunos::factory(10)->create();
        Contatos::factory(10)->create();
        Enderecos::factory(10)->create();
        Instrutores::factory(10)->create();
        Pessoas::factory(10)->create();
        Planos::factory(10)->create();
    }
}
