<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;

class SubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subsciptionPlans = [
            [
                'name' => 'Basic',
                'price' => 200000,
                'active_period_in_months' => 3,
                'features' => json_encode(['feature1', 'feature2']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Premium',
                'price' => 800000,
                'active_period_in_months' => 6,
                'features' => json_encode(['feature1', 'feature2', 'feature3', 'feature4']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        SubscriptionPlan::insert($subsciptionPlans);
    }
}
