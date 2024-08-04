<?php

namespace Database\Seeders;
use App\Models\Rating;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratingRecords = [
            ['id'=>1,'user_id'=>1,'product_id'=>1,'review'=>'good product','rating'=>4,'status'=>0],
            ['id'=>2,'user_id'=>5,'product_id'=>4,'review'=>'nice product','rating'=>5,'status'=>0],
            ['id'=>6,'user_id'=>5,'product_id'=>3,'review'=>'average product','rating'=>3,'status'=>0],
        ];

        Rating::insert($ratingRecords);
    }
}
