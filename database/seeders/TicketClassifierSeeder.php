<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketClassifierSeeder extends Seeder
{
    public function run(): void
    {
        // ჩავაყაროთ კატეგორიები
        DB::table('categories')->insert([
            ['name' => 'Technical Issue (IT)'],
            ['name' => 'Financial & Billing'],
            ['name' => 'Account Access'],
            ['name' => 'General Inquiry'],
        ]);

        // ჩავაყაროთ პრიორიტეტები
        DB::table('priorities')->insert([
            ['name' => 'Low'],
            ['name' => 'Medium'],
            ['name' => 'High'],
        ]);
    }
}