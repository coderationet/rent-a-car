<?php

namespace App\Models\Item;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $guarded = ['id'];

    public function children(){
        return $this->hasMany(ItemCategory::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(ItemCategory::class, 'parent_id');
    }

    // all children of a category without hierarchy
    public function allChildrenWithoutHierarchy($children = []){
        foreach ($this->children as $child) {
            $children[] = $child;
            if (count($child->children)) {
                $children = array_merge($children, $child->allChildrenWithoutHierarchy());
            }
        }
        return $children;
    }

    // requiresive children
    public function allChildrenWithHierarchy(){
        return $this->children()->with('allChildrenWithHierarchy');
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'category_item_map', 'category_id', 'item_id');
    }

    public function thumbnail(){
        return $this->belongsTo(Media::class, 'image_id');
    }

}
