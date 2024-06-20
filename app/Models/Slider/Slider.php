<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    public function sliderImages()
    {
        return $this->hasMany(SliderItem::class, 'slider_id', 'id')->orderBy('order', 'asc');
    }
}
