<?php

namespace Database\Seeders;

use App\Models\Affiliate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AffiliateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Affiliate::create([
            'user_id' => 1,
            'affiliate_name' => 'ADMIN',
            'affiliate_email' => 'admin@g.com',
            'affiliate_phone' => '1234567890',
            'is_active' => 1,
            'affiliate_code' => 'AFL1',
        ]);

        Affiliate::create([
            'user_id' => 2,
            'affiliate_name' => 'ORGANIC',
            'affiliate_email' => 'organic@g.com',
            'affiliate_phone' => '1234567891',
            'is_active' => 1,
            'affiliate_code' => 'AFL2',
        ]);
    }
}
