<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaAluno;

class AlunoCategoriaSeeder extends Seeder
{

    public function run(): void
    {
        CategoriaAluno::factory()->count(4)->create();
    }
}
