<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Laptops
        for($i = 1; $i <= 10; $i++){
            Product::create([
                'title' => 'Laptop '.$i,
                'slug' => 'laptop'.'-'.$i,
                'brand' => 'APPLE',
                'price' => rand(180000,220000),
                'details' => 'Processor - Six Core Intel Core i7 Processor Clock Speed - 2.2-4.1GHz Display Size - 15.4" RAM - 16GB RAM Type - DDR4 2400MHz (Onboard) Storage - 256GB SSD',
            ])->categories()->attach(1);
        }
        $product = Product::find(1);
        $product->categories()->attach(2);
        //Mobiles
        for($i = 1; $i <= 10; $i++){
            Product::create([
                'title' => 'Mobile '.$i,
                'slug' => 'mobile'.'-'.$i,
                'brand' => 'Mobile',
                'price' => rand(20000,35000),
                'details' => 'Seamless profile and controller pairing Responsive thumbsticks Triggers and bumpers are designed for quick access Menu and View buttons quick for easy navigation Remap buttons through the Xbox Accessories App',
            ])->categories()->attach(2);
        }
        //Tabltes
        for($i = 1; $i <= 10;$i++){
            Product::create([
                'title' => 'Tablet '.$i,
                'slug' => 'tablet'.'-'.$i,
                'brand' => 'Tablet',
                'price' => rand(18000,32000),
                'details' => 'Model - Huawei MediaPad T3 10 Processor Type - Qualcomm MSM8917 Quad Core A53 RAM - 2GB Processor Speed - 1.4GHz Internal Memory - 16GB ROM Display Type - IPS display Display Size - 9.6" Screen Resolution - 1280 x 800',
            ])->categories()->attach(3);
        }
        //Bluetooth speakers
        for($i = 1; $i <= 10; $i++){
            Product::create([
                'title' => 'Bluetooth Speaker '.$i,
                'slug' => 'bluetooth-speakers'.'-'.$i,
                'brand' => 'JOYROOM',
                'price' => rand(2900,10000),
                'details' => 'Input：5V 2A Output：5V 2.1A Power: 10000 mAh Digital Display LED Lighting',
            ])->categories()->attach(4);
        }
        //Cameras
        for($i = 1; $i <= 20; $i++){
            Product::create([
                'title' => 'Camera '.$i,
                'slug' => 'camera'.'-'.$i,
                'brand' => 'A4TECH',
                'price' => rand(30000,90000),
                'details' => 'Driver Unit: 40 mm Neodymium Magnet Frequency Response: 20-20000 Hz Sensitivity: 100 dBImpedance: 32 ohm',
            ])->categories()->attach(5);
        }
        //Appliances
        for($i = 1; $i <= 15;$i++)
        {
            Product::create([
                'title' => 'Appliances '.$i,
                'slug' => 'appliance'.'-'.$i,
                'brand' => 'Appliances',
                'price' => rand(45000,55000),
                'details' => 'Display: 1.2” (240 x 240) Display type: Sunlight-visible, transflective memory-in-pixel (MIP) Memory: 64MB Lens Material: chemically strengthened glass or sapphire crystal Bezel Material: Stainless steel Strap material: silicone',
            ])->categories()->attach(6);
        }
    }
}
