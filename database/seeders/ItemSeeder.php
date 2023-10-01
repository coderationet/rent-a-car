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

        // Item attributes
        $status_attribute = Attribute::create(['name' => 'Status', 'type' => 'select', 'slug' => 'status']);
        $status_attribute->values()->create(['value' => 'New']);
        $status_attribute->values()->create(['value' => '2nd Hand']);

        $location_attribute = Attribute::create(['name' => 'Location', 'type' => 'select', 'slug' => 'location']);
        $location_1 = $location_attribute->values()->create(['value' => 'Alanya, Antalya']);
        $location_2 = $location_attribute->values()->create(['value' => 'Dalyan, Muğla']);
        $location_3 = $location_attribute->values()->create(['value' => 'Roma, Italy']);
        $location_4 = $location_attribute->values()->create(['value' => 'London, UK']);


        $bedroom_attribute = Attribute::create(['name' => 'Bedroom', 'type' => 'select', 'slug' => 'bedroom']);
        $bedroom_attribute->values()->create(['value' => '1 Bedroom']);
        $bedroom_attribute->values()->create(['value' => '2 Bedrooms']);
        $bedroom_attribute->values()->create(['value' => '3 Bedrooms']);
        $bedroom_attribute->values()->create(['value' => '4 Bedrooms']);

        $m2_attribute = Attribute::create(['name' => 'm2', 'type' => 'select', 'slug' => 'm2']);
        $m2_attribute->values()->create(['value' => '0-50 m2']);
        $m2_attribute->values()->create(['value' => '50-100 m2']);
        $m2_attribute->values()->create(['value' => '100-150 m2']);
        $m2_attribute->values()->create(['value' => '150-200 m2']);

        $libing_room_attribute = Attribute::create(['name' => 'Living Room', 'type' => 'select', 'slug' => 'living-room']);
        $libing_room_attribute->values()->create(['value' => '1 Living Room']);
        $libing_room_attribute->values()->create(['value' => '2 Living Rooms']);
        $libing_room_attribute->values()->create(['value' => '3 Living Rooms']);
        $libing_room_attribute->values()->create(['value' => '4 Living Rooms']);

        $en_suite_bathroom_attribute = Attribute::create(['name' => 'En-suit Bathroom', 'type' => 'select', 'slug' => 'en-suit-bathroom']);
        $en_suite_bathroom_attribute->values()->create(['value' => '1 En-suit Bathroom']);
        $en_suite_bathroom_attribute->values()->create(['value' => '2 En-suit Bathrooms']);
        $en_suite_bathroom_attribute->values()->create(['value' => '3 En-suit Bathrooms']);
        $en_suite_bathroom_attribute->values()->create(['value' => '4 En-suit Bathrooms']);

        $pool_attribute = Attribute::create(['name' => 'Pool', 'type' => 'select', 'slug' => 'pool']);
        $pool_attribute->values()->create(['value' => 'Private Pool']);
        $pool_attribute->values()->create(['value' => 'Communal Pool']);
        $pool_attribute->values()->create(['value' => 'No Pool']);

        $poolm2_attribute = Attribute::create(['name' => 'Pool m2', 'type' => 'select', 'slug' => 'pool-m2']);
        $poolm2_attribute->values()->create(['value' => '0-50 m2']);
        $poolm2_attribute->values()->create(['value' => '50-100 m2']);
        $poolm2_attribute->values()->create(['value' => '100-150 m2']);

        $garden_attribute = Attribute::create(['name' => 'Garden', 'type' => 'select', 'slug' => 'garden']);
        $garden_attribute->values()->create(['value' => 'Private Garden']);
        $garden_attribute->values()->create(['value' => 'Communal Garden']);
        $garden_attribute->values()->create(['value' => 'No Garden']);

        $garden_m2_attribute = Attribute::create(['name' => 'Garden m2', 'type' => 'select', 'slug' => 'garden-m2']);
        $garden_m2_attribute->values()->create(['value' => '0-50 m2']);
        $garden_m2_attribute->values()->create(['value' => '50-100 m2']);
        $garden_m2_attribute->values()->create(['value' => '100-150 m2']);

        $Furnished_attribute = Attribute::create(['name' => 'Furnished', 'type' => 'select', 'slug' => 'furnished']);
        $Furnished_attribute->values()->create(['value' => 'Fully Furnished']);
        $Furnished_attribute->values()->create(['value' => 'Partially Furnished']);
        $Furnished_attribute->values()->create(['value' => 'Unfurnished']);

        $number_of_floor_attribute = Attribute::create(['name' => 'Number of Floor', 'type' => 'select', 'slug' => 'number-of-floor']);
        $number_of_floor_attribute->values()->create(['value' => '1 Floor']);
        $number_of_floor_attribute->values()->create(['value' => '2 Floors']);
        $number_of_floor_attribute->values()->create(['value' => '3 Floors']);
        $number_of_floor_attribute->values()->create(['value' => '4 Floors']);

        $in_the_complex_attribute = Attribute::create(['name' => 'In the Complex', 'type' => 'select', 'slug' => 'in-the-complex']);
        $in_the_complex_attribute->values()->create(['value' => 'Yes']);
        $in_the_complex_attribute->values()->create(['value' => 'No']);

        $heating_attribute = Attribute::create(['name' => 'Heating', 'type' => 'select', 'slug' => 'heating']);
        $heating_attribute->values()->create(['value' => 'Air Conditioning']);
        $heating_attribute->values()->create(['value' => 'Central Heating']);
        $heating_attribute->values()->create(['value' => 'Fire Place']);
        $heating_attribute->values()->create(['value' => 'Solar Energy']);

        $villa_type = Attribute::create(['name' => 'Villa Type', 'type' => 'select', 'slug' => 'villa-type']);
        $villa_type->values()->create(['value' => 'Detached Villa']);
        $villa_type->values()->create(['value' => 'Semi Detached Villa']);
        $villa_type->values()->create(['value' => 'Twin Villa']);
        $villa_type->values()->create(['value' => 'Triplex Villa']);


        $views_attribute = Attribute::create(['name' => 'Views', 'type' => 'multiselect', 'slug' => 'views']);
        // sea, mountain, city, forest, lake, river, pool, garden, street, valley, castle, island, canyon, golf, ski
        $views_attribute->values()->create(['value' => 'Sea']);
        $views_attribute->values()->create(['value' => 'Mountain']);
        $views_attribute->values()->create(['value' => 'City']);
        $views_attribute->values()->create(['value' => 'Forest']);
        $views_attribute->values()->create(['value' => 'Lake']);
        $views_attribute->values()->create(['value' => 'River']);

        // people attribute
        $people_attribute = Attribute::create(['name' => 'People', 'type' => 'select', 'slug' => 'people']);
        $people_attribute->values()->create(['value' => '1-2 People']);
        $people_attribute->values()->create(['value' => '2-4 People']);
        $people_attribute->values()->create(['value' => '4-6 People']);
        $people_attribute->values()->create(['value' => '6-8 People']);

        // categories For Sale, For Rent, For Holiday
        $for_sale_category = ItemCategory::create(['name' => 'For Sale Villas', 'slug' => 'for-sale']);
        $for_rent_category = ItemCategory::create(['name' => 'For Rent Villas', 'slug' => 'for-rent']);
        $for_holiday_category = ItemCategory::create(['name' => 'For Holiday Villas', 'slug' => 'for-holiday']);


        $thumbnail = Media::create([
            'name' => 'default/thumbnail.webp',
            'type' => 'image',
        ]);

        for ($i=1; $i<100;$i++){
            $category_id = rand(1,3);
            // create item
            $item = Item::create([
                'title' => 'Villa '.$i,
                'slug' => 'villa-'.$i,
                'description' => 'Villa '.$i.' description<br>'
                . "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget ultricies aliquam, "
                . "nunc nisl ultricies diam, eu tincidunt nisl nisl eget nunc. Donec euismod, nisl eget ultricies aliquam, "
                . "nunc nisl ultricies diam, eu tincidunt nisl nisl eget nunc. Donec euismod, nisl eget ultricies aliquam, ",
                'price' => rand(1000, 100000),
                'thumbnail_id' => $thumbnail->id,
            ]);

            $item->categories()->attach($category_id);

            for ($attribute_id = 1;$attribute_id <=17;$attribute_id++){

                $values = AttributeValue::where('attribute_id', $attribute_id)->get();
                $value = $values[rand(0, count($values)-1)];

                $item->attributeValues()->attach($value->id);

            }


        }

    }
}
