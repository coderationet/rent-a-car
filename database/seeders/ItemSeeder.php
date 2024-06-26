<?php

namespace Database\Seeders;

use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeValue;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Media;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brand = Attribute::create(['name' => 'Brand', 'type' => 'select', 'slug' => 'brand']);
        $brand->values()->create(['value' => 'Fiat']);
        $brand->values()->create(['value' => 'Ford']);
        $brand->values()->create(['value' => 'Mercedes']);
        $brand->values()->create(['value' => 'BMW']);
        $brand->values()->create(['value' => 'Audi']);
        $brand->values()->create(['value' => 'Volkswagen']);
        $brand->values()->create(['value' => 'Renault']);

        $location = Attribute::create(['name' => 'Location', 'type' => 'multiselect', 'slug' => 'location']);
        $location->values()->create(['value' => 'İstanbul']);
        $location->values()->create(['value' => 'Ankara']);
        $location->values()->create(['value' => 'İzmir']);
        $location->values()->create(['value' => 'Bursa']);


        $car_thumbnail = Media::create([
            'name' => 'default/category-car.png',
            'type' => 'image',
        ]);

        // categories For Sale, For Rent, For Holiday
        $cars = ItemCategory::create(['name' => 'Cars', 'slug' => 'cars','short_description' => 'Cars category description']);
        $cars->image_id = $car_thumbnail->id;
        $cars->save();

        $car_thumbnail = Media::create([
            'name' => 'default/category-bicycles.webp',
            'type' => 'image',
        ]);
        $bicycles = ItemCategory::create(['name' => 'Bicycles', 'slug' => 'bicycles','short_description' => 'Bicycles category description']);
        $bicycles->image_id = $car_thumbnail->id;
        $bicycles->save();

        $moto_thumbnail = Media::create([
            'name' => 'default/category-motobike.jpg',
            'type' => 'image',
        ]);
        $moto = ItemCategory::create(['name' => 'Motors', 'slug' => 'motors','short_description' => 'Motors category description']);
        $moto->image_id = $moto_thumbnail->id;
        $moto->save();


        $atv_thumbnail = Media::create([
            'name' => 'default/category-atv.jpg',
            'type' => 'image',
        ]);
        $atv = ItemCategory::create(['name' => 'ATV', 'slug' => 'atv','short_description' => 'ATV category description']);
        $atv->image_id = $atv_thumbnail->id;
        $atv->save();

        $thumbnail = Media::create([
            'name' => 'default/thumbnail.webp',
            'type' => 'image',
        ]);

        $item_thumbnail = Media::create([
            'name' => 'default/default-item-thumb.jpg',
            'type' => 'image',
        ]);

        for ($i=1; $i<100;$i++){

            $category_id = rand(1,4);
            // create item
            $item = Item::create([
                'title' => 'Car '.$i,
                'slug' => 'car-'.$i,
                'description' => 'Car '. $i . ' description',
                'price' => rand(1000, 100000),
                'thumbnail_id' => $item_thumbnail->id,
            ]);

            $item->categories()->attach($category_id);

            // attach to random brand
            $item->attributeValues()->attach(AttributeValue::where('attribute_id', $brand->id)->inRandomOrder()->first()->id);

            // attach 2 random locations
            $item->attributeValues()->attach(AttributeValue::where('attribute_id', $location->id)->inRandomOrder()->first()->id);

        }

    }
}
