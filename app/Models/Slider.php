<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    public function sliderImages()
    {
        return $this->hasMany(SliderItem::class, 'slider_id', 'id')->orderBy('order', 'asc');
    }
}
