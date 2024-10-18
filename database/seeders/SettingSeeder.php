<?php

namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'compay_name' => 'ABC',
            'email' => 'abc@gmail.com',
            'mobile' => '0243564657',
            'address' => 'ABC',
            'logo' => 'logo.png',
            'creator' =>1,

            
        ]);
    }
}
