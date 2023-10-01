<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }

    public function gallery()
    {
        return $this->belongsToMany(Media::class, 'item_images');
    }

    // attribute values via pivot table
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value_x_items', 'item_id', 'attribute_value_id');
    }

    public function categories(){
        return $this->belongsToMany(ItemCategory::class, 'category_item_map', 'item_id', 'category_id');
    }
}


