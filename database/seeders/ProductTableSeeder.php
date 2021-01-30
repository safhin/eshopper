<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'A4TECH BLOODY G437',
            'slug' => 'a4tech-bloody-g437',
            'brand' => 'A4TECH',
            'price' => 3000,
            'details' => 'Driver Unit: 40 mm Neodymium Magnet Frequency Response: 20-20000 Hz Sensitivity: 100 dBImpedance: 32 ohm',
        ]);
        Product::create([
            'title' => 'NIKON D7200 CAMERA',
            'slug' => 'nikon-d7200-camera',
            'brand' => 'NIKON',
            'price' => 3000,
            'details' => 'Model - Nikon D7200 Effective Pixels - 24.2 Megapixels Lens Mount - AF-S 18-140mm Processor - Expeed 4 Sensor Type - CMOS Sensor Screen Type - TFT LCD Screen Size - 3.2',
        ]);
        Product::create([
            'title' => 'MICROSOFT XBOX ONE',
            'slug' => 'microsoft-xbox-one',
            'brand' => 'MICROSOFT',
            'price' => 4300,
            'details' => 'Seamless profile and controller pairing Responsive thumbsticks Triggers and bumpers are designed for quick access Menu and View buttons quick for easy navigation Remap buttons through the Xbox Accessories App',
        ]);
        Product::create([
            'title' => 'JOYROOM ZHI 10000 MAH',
            'slug' => 'joyroom-zhi-10000-mah',
            'brand' => 'JOYROOM',
            'price' => 2900,
            'details' => 'Input：5V 2A Output：5V 2.1A Power: 10000 mAh Digital Display LED Lighting',
        ]);
        Product::create([
            'title' => 'APPLE MACBOOK PRO (2018)',
            'slug' => 'apple-mackbook-pro',
            'brand' => 'APPLE',
            'price' => 205000,
            'details' => 'Processor - Six Core Intel Core i7 Processor Clock Speed - 2.2-4.1GHz Display Size - 15.4" RAM - 16GB RAM Type - DDR4 2400MHz (Onboard) Storage - 256GB SSD',
        ]);
        Product::create([
            'title' => 'BEATS PILL PLUS',
            'slug' => 'beats-pill-plus',
            'brand' => 'BEATS',
            'price' => 20000,
            'details' => 'PSKU: RAMBPSHSP Brand: Beats Active 2-way crossove',
        ]);
        Product::create([
            'title' => 'GARMIN FENIX 5 SAPPHIRE',
            'slug' => 'garmin-fenix-5-sapphire',
            'brand' => 'GARMIN',
            'price' => 43000,
            'details' => 'Display: 1.2” (240 x 240) Display type: Sunlight-visible, transflective memory-in-pixel (MIP) Memory: 64MB Lens Material: chemically strengthened glass or sapphire crystal Bezel Material: Stainless steel Strap material: silicone',
        ]);
        Product::create([
            'title' => 'APPLE MAGIC KEYBOARD',
            'slug' => 'apple-magic-keyboard',
            'brand' => 'APPLE',
            'price' => 9500,
            'details' => 'APPLE MAGIC KEYBOARD (MLA22ZA/A, MLA22LL/A)',
        ]);
        Product::create([
            'title' => 'HUAWEI MEDIAPAD T3',
            'slug' => 'huawei-media-t3',
            'brand' => 'HUAWEI',
            'price' => 18900,
            'details' => 'Model - Huawei MediaPad T3 10 Processor Type - Qualcomm MSM8917 Quad Core A53 RAM - 2GB Processor Speed - 1.4GHz Internal Memory - 16GB ROM Display Type - IPS display Display Size - 9.6" Screen Resolution - 1280 x 800',
        ]);
    }
}
