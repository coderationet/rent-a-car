<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';

    const STATUS_PENDING = 'pending';

    const STATUS_CREATED = 'created';

    protected $guarded = ['id'];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
