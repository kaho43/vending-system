<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            ['company_name' => 'Coca-Cola', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'サントリー', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'キリン', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
