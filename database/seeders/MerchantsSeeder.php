<?php

namespace Database\Seeders;

use App\Enums\PaymentGatewayType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantsSeeder extends Seeder
{
    const MERCHANTS = [
        [
            'id' => 6,
            'key' => 'KaTf5tZYHx4v7pgZ',
            'gateway' => PaymentGatewayType::GATEWAY1,
        ],
        [
            'id' => 816,
            'key' => 'rTaasVHeteGbhwBx',
            'gateway' => PaymentGatewayType::GATEWAY2,
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('merchants')->upsert(self::MERCHANTS, ['id'], ['key', 'gateway']);
    }
}
