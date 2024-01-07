<?php

namespace App\Models\Authorizon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionDescription extends Model
{

    use SoftDeletes;

    protected $table = 'permission_descriptions';
    protected $primaryKey = 'permission_description_id';

    public $timestamps = true;

    protected $fillable = [
        'permission_id',
        'name',
        'description',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
