<?php

namespace App\Helpers;

use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeHelper
{
    public static function itemAttributes($item)
    {
        $attributes = [];

        if ($item->relationLoaded('attributeValues') === false) {
            $item->load('attributeValues.attribute');
        }

        foreach ($item->attributeValues as $attributeValue) {
            if (!isset($attributes[$attributeValue->attribute->id])) {
                $attributes[$attributeValue->attribute->id] = [
                    'id' => $attributeValue->attribute->id,
                    'name' => $attributeValue->attribute->name,
                    'type' => $attributeValue->attribute->type,
                    'values' => []
                ];
                $attributes[$attributeValue->attribute->id]['values'][] = [
                    'id' => $attributeValue->id,
                    'name' => $attributeValue->value
                ];
                continue;
            }

            $attributes[$attributeValue->attribute->id]['values'][] = [
                'id' => $attributeValue->id,
                'name' => $attributeValue->value
            ];

        }
        return $attributes;
    }


    public static function defaultItemAttributes($item = null)
    {

        $default_attributes = config('website.default_attributes');

        $attributes = [];

        if ($item !== null) {
            if ($item->relationLoaded('attributeValues') === false) {
                $item->load('attributeValues.attribute');
            }
        }

        // default attributes are the attributes that are already set for the item they can be empty but still need to be shown
        if (count($default_attributes) && config('website.strict_attributes')) {

            $default_attributes = Attribute::whereIn('id', $default_attributes)->get();


            foreach ($default_attributes as $attribute) {
                if (!isset($attributes[$attribute->id])) {
                    $attributes[$attribute->id] = [
                        'id' => $attribute->id,
                        'name' => $attribute->name,
                        'type' => $attribute->type,
                        'values' => []
                    ];
                    continue;
                }
            }


            // set item values for the attribute

            if ($item !== null) {
                foreach ($attributes as $attribute) {
                    $attribute_values = AttributeValue::whereHas('items', function ($query) use ($item) {
                        $query->where('item_id', $item->id);
                    })->where('attribute_id', $attribute['id'])->get();

                    foreach ($attribute_values as $attribute_value) {
                        $attributes[$attribute['id']]['values'][] = [
                            'id' => $attribute_value->id,
                            'name' => $attribute_value->value
                        ];
                    }
                }

            }


            return $attributes;
        }

    }

}
