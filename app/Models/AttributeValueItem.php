<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValueItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "attribute_value_x_items";
    public $timestamps = false;

    // item
    public function item(){
        return $this->belongsTo(Item::class);
    }

    // attribute value
    public function attributeValue(){
        return $this->belongsTo(AttributeValue::class);
    }
}
