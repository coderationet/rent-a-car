<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function values()
    {
        return $this->hasMany(AttributeValue::class)->orderBy('value', 'asc');
    }
}
