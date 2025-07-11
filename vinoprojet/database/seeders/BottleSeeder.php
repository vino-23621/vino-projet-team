<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;

class BottleSeeder extends Seeder
{
    public function run()
    {
        $json = Storage::get('data/bottles.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {

            $identity = Identity::firstOrCreate(['name' => $item['identity']]);

            $country = Country::firstOrCreate(['name' => $item['country']]);

            Bottle::create([
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => $item['image'],
                'price' => $item['price'],
                'size' => $item['size'],
                'vintage' => $item['vintage'],
                'identity_id' => $identity->id,
                'country_id' => $country->id,
            ]);
        }
    }
}
