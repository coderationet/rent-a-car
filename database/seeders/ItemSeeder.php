<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\AttributeValueItem;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brand = Attribute::create(['name' => 'Marka', 'type' => 'select', 'slug' => 'brand']);
        $brand->values()->create(['value' => 'Fiat']);
        $brand->values()->create(['value' => 'Ford']);
        $brand->values()->create(['value' => 'Mercedes']);
        $brand->values()->create(['value' => 'BMW']);
        $brand->values()->create(['value' => 'Audi']);
        $brand->values()->create(['value' => 'Volkswagen']);
        $brand->values()->create(['value' => 'Renault']);

        $location = Attribute::create(['name' => 'Konum', 'type' => 'multiselect', 'slug' => 'location']);
        $location->values()->create(['value' => 'İstanbul']);
        $location->values()->create(['value' => 'Ankara']);
        $location->values()->create(['value' => 'İzmir']);
        $location->values()->create(['value' => 'Bursa']);


        // categories For Sale, For Rent, For Holiday
        $for_sale_category = ItemCategory::create(['name' => 'Araba', 'slug' => 'cars']);
        $for_rent_category = ItemCategory::create(['name' => 'Bisiklet', 'slug' => 'bycicles']);
        $for_holiday_category = ItemCategory::create(['name' => 'Motor', 'slug' => 'motors']);
        $for_holiday_category = ItemCategory::create(['name' => 'ATV', 'slug' => 'atv']);


        $thumbnail = Media::create([
            'name' => 'default/thumbnail.webp',
            'type' => 'image',
        ]);

        for ($i=1; $i<100;$i++){

            $category_id = rand(1,3);
            // create item
            $item = Item::create([
                'title' => 'Car '.$i,
                'slug' => 'car-'.$i,
                'description' => 'Car '. $i . ' description',
                'price' => rand(1000, 100000),
                'thumbnail_id' => $thumbnail->id,
            ]);

            $item->categories()->attach($category_id);

            // attach to random brand
            $item->attributeValues()->attach(AttributeValue::where('attribute_id', $brand->id)->inRandomOrder()->first()->id);

            // attach 2 random locations
            $item->attributeValues()->attach(AttributeValue::where('attribute_id', $location->id)->inRandomOrder()->first()->id);

        }

    }
}
