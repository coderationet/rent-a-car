<?php

namespace App\Models\Slider;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'file_desktop',
        'file_mobile',
        'link',
        'link_text',
        'order',
        'slider_id'
    ];

    public $timestamps = false;

    public function mobile() {
        return $this->hasOne(Media::class, 'id', 'file_mobile');
    }

    public function desktop() {
        return $this->hasOne(Media::class, 'id', 'file_desktop');
    }
}
