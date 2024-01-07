<?php

namespace App\Models\Attribute;

use App\Models\Item\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'attribute_value_x_items', 'attribute_value_id', 'item_id');
    }

    public function items2(){
        $this->belongsToMany(Item::class, 'attribute_value_x_items', 'attribute_value_id', 'item_id');
    }
}
