<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;

class BottleSeeder extends Seeder
{
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Bottle::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $json = Storage::get('data/bottles.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {

            $identity = Identity::firstOrCreate(['name' => $item['identity']]);
            $country = Country::firstOrCreate(['name' => $item['country']]);


            Bottle::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                    'grape_variety' => $item['grape_variety'],
                    'appellation' => $item['appellation'],
                    'alcohol_percentage' => (float) $item['alcohol_percentage'],
                    'sugar' => (float) $item['sugar'],
                    'size' => (int) $item['size'],
                    'vintage' => $item['vintage'] ? (int) $item['vintage'] : null,
                    'identity_id' => $identity->id,
                    'country_id' => $country->id,
                ]
            );
        }
    }
}
